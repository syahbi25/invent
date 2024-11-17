<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\AbsencesExport;
use App\Imports\AbsencesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        $search = $request->input('search', '');  // Default to empty if search is not provided

        // Start building the query
        $query = Absence::with('employee');

        // If there's a search term, add where clauses to the query
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('employee', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('position', 'like', "%{$search}%");
                })
                    ->orWhere('absence_date', 'like', "%{$search}%");
            });
        }

        // Get paginated results
        $absences = $query->paginate(10);

        // Process each absence record for display
        foreach ($absences as $absence) {
            // Calculate day_name
            $absence->day_name = Carbon::parse($absence->absence_date)->translatedFormat('l');

            // Calculate work duration
            $startTime = Carbon::parse($absence->start_time);
            $endTime = Carbon::parse($absence->end_time);
            $duration = $startTime->diffInHours($endTime);
            $absence->duration = $duration;

            // Calculate total wage and overtime pay if an employee is associated
            if ($absence->employee) {
                $absence->total_wage = $absence->employee->fee * $duration;
                $absence->overtime_pay = $absence->overtime_duration
                    ? $absence->employee->overtime_wage * $absence->overtime_duration
                    : 0;
            }
        }

        return view('absences.index', compact('absences', 'search'));
    }

    public function importExport()
    {
        return view('absences.importexport');
    }

    public function export()
    {
        return Excel::download(new AbsencesExport, 'absences-' . Carbon::now()->format('d-m-Y') . '.xlsx');

        return redirect()->route('absences.index')->with(['success' => 'Export Data Absensi Berhasil!']);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new AbsencesImport, $request->file('file'));

        return redirect()->route('absences.index')->with('success', 'Data absensi berhasil diimport.');
    }

    // Menampilkan form absensi baru
    public function create()
    {
        $employees = Employee::all();
        return view('absences.create', compact('employees'));
    }

    // Menampilkan karyawan yang belum absen di tanggal yang dipilih
    public function showEmployeesForDate(Request $request)
    {
        // Periksa apakah ada parameter 'date' dalam request
        if ($request->has('date')) {
            $selectedDate = $request->date;
        } else {
            $selectedDate = session('absence_date', null);
        }
        // Cek apakah tanggal sudah ada di database
        $absencesOnDate = Absence::where('absence_date', $selectedDate)->get();

        if ($absencesOnDate->isEmpty()) {
            // Jika belum ada absensi di tanggal tersebut, ambil semua karyawan
            $employees = Employee::all();

            return view('absences.mark_absences', compact('employees', 'selectedDate'));
        } else {
            // Jika sudah ada absensi, ambil ID karyawan yang sudah absen
            $absentEmployeeIds = $absencesOnDate->pluck('employee_id')->toArray();

            // Ambil karyawan yang belum absen
            $employees = Employee::whereNotIn('id', $absentEmployeeIds)->get();

            return view('absences.mark_absences', compact('employees', 'selectedDate'));
        }
    }

    public function getAbsenceSummary(Request $request)
    {
        // Get the start_year, end_year, and other filters
        $startYear = $request->get('start_year', date('Y')); // Default to current year if not provided
        $endYear = $request->get('end_year', date('Y')); // Default to current year if not provided
        $month = $request->get('month'); // Optional, could be null for all months
        $selectedEmployeeId = $request->get('employee_id'); // Get the selected employee ID
        $selectedPosition = $request->get('position'); // Get the selected position
        $selectedGrade = $request->get('grade'); // Get the selected grade

        // Fetch employees along with their absences
        $employeesQuery = Employee::with(['absences' => function ($query) use ($startYear, $endYear, $month) {
            // Filter absences between the start and end year
            $query->whereYear('absence_date', '>=', $startYear)
                ->whereYear('absence_date', '<=', $endYear);

            // If a month is selected, filter by month as well
            if ($month) {
                $query->whereMonth('absence_date', $month);
            }
        }]);

        // If an employee is selected, filter the query
        if ($selectedEmployeeId) {
            $employeesQuery->where('id', $selectedEmployeeId);
        }

        // If a position is selected, filter the query
        if ($selectedPosition) {
            $employeesQuery->where('position', $selectedPosition);
        }

        // If a grade is selected, filter the query
        if ($selectedGrade) {
            $employeesQuery->where('grade', $selectedGrade);
        }

        $employees = $employeesQuery->get();

        // Calculate absence statistics for each employee
        foreach ($employees as $employee) {
            $employee->total_hadir = $employee->absences->where('reason', 'Hadir')->count();
            $employee->total_ijin = $employee->absences->where('reason', 'Ijin')->count();
            $employee->total_sakit = $employee->absences->where('reason', 'Sakit')->count();
            $employee->total_tanpa_keterangan = $employee->absences->where('reason', 'Tanpa Keterangan')->count();
            $employee->total_absences = $employee->absences->count();
        }

        // Get all employees for the name filter
        $allEmployees = Employee::all();

        // Get distinct positions and grades for filtering
        $positions = Employee::distinct()->pluck('position');
        $grades = Employee::distinct()->pluck('grade');

        // Pass data to view
        return view('absences.absences_summary', compact(
            'employees',
            'allEmployees',
            'startYear',
            'endYear',
            'month',
            'selectedEmployeeId',
            'positions',
            'grades',
            'selectedPosition',
            'selectedGrade'
        ));
    }



    // Menyimpan absensi baru
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'employee_id' => 'required|array', // Employee IDs harus array
            'reason.*' => 'required|string',
            'start_time.*' => 'required|date_format:H:i', // Waktu mulai untuk setiap karyawan
            'end_time.*' => 'required|date_format:H:i',   // Waktu selesai untuk setiap karyawan
            'overtime_duration.*' => 'nullable|numeric|min:0', // Durasi lembur untuk setiap karyawan
        ]);

        // Tanggal absensi
        $absenceDate = $request->input('absence_date');

        // Loop melalui setiap karyawan yang dipilih
        foreach ($request->employee_id as $employeeId) {
            $startTime = $request->input("start_time.$employeeId");
            $endTime = $request->input("end_time.$employeeId");
            $overtimeDuration = $request->input("overtime_duration.$employeeId", 0); // Default lembur 0 jika kosong
            $reason = $request->input("reason.$employeeId");

            // Simpan data absensi untuk setiap karyawan
            Absence::create([
                'employee_id' => $employeeId,
                'absence_date' => $absenceDate,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'overtime_duration' => $overtimeDuration,
                'reason' => $reason,
            ]);
        }

        // Simpan tanggal ke session
        session(['absence_date' => $request->absence_date]);

        // Redirect kembali ke show-employees dengan success message
        return redirect()->route('absences.showEmployees')->with('success', 'Absences recorded successfully.');
    }

    // Menampilkan detail absensi
    public function show($id)
    {
        $absence = Absence::findOrFail($id);
        return view('absences.show', compact('absence'));
    }

    // Menampilkan form edit absensi
    public function edit($id)
    {
        $absence = Absence::findOrFail($id);
        $employees = Employee::all();
        return view('absences.edit', compact('absence', 'employees'));
    }

    // Memperbarui absensi
    public function update(Request $request, $id)
    {
        $absence = Absence::findOrFail($id);

        // Validasi input dari form
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'absence_date' => 'required|date',
            'start_time' => 'required', // Waktu mulai untuk setiap karyawan
            'end_time' => 'required',   // Waktu selesai untuk setiap karyawan
            'overtime_duration' => 'nullable|numeric|min:0', // Durasi lembur untuk setiap karyawan
            'reason' => 'required|string',
        ]);
        // Temukan absensi berdasarkan ID
        $absence = Absence::findOrFail($id);

        // Perbarui data absensi
        $absence->employee_id = $request->input('employee_id');
        $absence->absence_date = $request->input('absence_date');
        $absence->start_time = $request->input('start_time');
        $absence->end_time = $request->input('end_time');
        $absence->overtime_duration = $request->input('overtime_duration');
        $absence->reason = $request->input('reason');

        // Simpan perubahan ke database
        $absence->save();

        return redirect()->route('absences.index')->with('success', 'Absence updated successfully.');
    }

    // Menghapus absensi
    public function destroy($id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();

        return redirect()->route('absences.index')->with('success', 'Absence deleted successfully.');
    }

    public function deleteAll()
    {
        // Truncate both tables
        Absence::truncate();

        return redirect()->route('absences.index')->with('success', 'All absences have been deleted successfully.');
    }
}
