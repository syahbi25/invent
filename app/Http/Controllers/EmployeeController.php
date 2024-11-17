<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Absence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $employees = Employee::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('position', 'LIKE', "%{$search}%")
                ->orWhere('grade', 'LIKE', "%{$search}%");
        })->paginate(10);

        $search = $request->input('search');
        $showAll = $request->has('show_all'); // Check if 'show_all' parameter is present

        $employees = Employee::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('position', 'LIKE', "%{$search}%")
                ->orWhere('grade', 'LIKE', "%{$search}%");
        });

        // Determine whether to paginate or get all employees
        $employees = $showAll ? $employees->get() : $employees->paginate(10);

        return view('employees.index', compact('employees', 'search', 'showAll'));
    }


    // Menampilkan form untuk membuat karyawan baru
    public function create()
    {
        return view('employees.create');
    }
    public function importExport()
    {
        return view('employees.importexport');
    }
    // Export function
    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees-' . Carbon::now()->format('d-m-Y') . '.xlsx');
        return redirect()->route('employees.index')->with(['success' => 'Export Data Berhasil!']);
    }

    // Import function
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new EmployeesImport, $request->file('file'));

        return redirect()->back()->with('success', 'Employees imported successfully.');
    }

    // Menyimpan karyawan baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email|max:255',
            'position' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
            'overtime_wage' => 'required|numeric|min:0',
        ]);

        Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    // Menampilkan detail karyawan
    public function showAll($id)
    {

        Carbon::setLocale('id');
        // Ambil data karyawan berdasarkan ID dan termasuk absensinya
        // $employee = Employee::with('absences')->findOrFail($id);
        $employee = Employee::findOrFail($id);


        // Lakukan perhitungan gaji setiap absensi
        $totalSalary = 0;
        $absencesWithSalary = [];

        foreach ($employee->absences as $absence) {

            $absence->day_name = Carbon::parse($absence->absence_date)->translatedFormat('l');
            $workingDuration = (strtotime($absence->end_time) - strtotime($absence->start_time)) / 3600; // Konversi ke jam
            $regularSalary = $employee->fee * $workingDuration; // Gaji reguler berdasarkan jam kerja
            $overtimeSalary = $employee->overtime_wage * $absence->overtime_duration; // Gaji lembur

            // Gaji total untuk absensi tersebut
            $totalAbsenceSalary = $regularSalary + $overtimeSalary;

            // Simpan hasil perhitungan
            $absencesWithSalary[] = [
                'day_name' => $absence->day_name,
                'absence_date' => $absence->absence_date,
                'start_time' => $absence->start_time,
                'end_time' => $absence->end_time,
                'overtime_duration' => $absence->overtime_duration,
                'regular_salary' => $regularSalary,
                'overtime_salary' => $overtimeSalary,
                'total_salary' => $totalAbsenceSalary,
                'is_paid' => $absence->is_paid,
                'payment_info' => $absence->payment_info,
            ];

            // Tambahkan ke total gaji
            $totalSalary += $totalAbsenceSalary;
        }

        return view('employees.showAll', compact('employee', 'absencesWithSalary', 'totalSalary'));
    }

    // Menampilkan detail karyawan
    public function show($id)
    {

        Carbon::setLocale('id');
        // Ambil data karyawan berdasarkan ID dan termasuk absensinya
        // $employee = Employee::with('absences')->findOrFail($id);
        $employee = Employee::with(['absences' => function ($query) {
            $query->where('reason', 'Hadir') // Hanya absences yang belum dibayar
                ->where('payment_info', false); // Hanya absences yang belum dibayar
        }])->findOrFail($id);


        // Lakukan perhitungan gaji setiap absensi
        $totalSalary = 0;
        $absencesWithSalary = [];

        foreach ($employee->absences as $absence) {

            $absence->day_name = Carbon::parse($absence->absence_date)->translatedFormat('l');
            $workingDuration = (strtotime($absence->end_time) - strtotime($absence->start_time)) / 3600; // Konversi ke jam
            $regularSalary = $employee->fee * $workingDuration; // Gaji reguler berdasarkan jam kerja
            $overtimeSalary = $employee->overtime_wage * $absence->overtime_duration; // Gaji lembur

            // Gaji total untuk absensi tersebut
            $totalAbsenceSalary = $regularSalary + $overtimeSalary;

            // Simpan hasil perhitungan
            $absencesWithSalary[] = [
                'day_name' => $absence->day_name,
                'absence_date' => $absence->absence_date,
                'start_time' => $absence->start_time,
                'end_time' => $absence->end_time,
                'overtime_duration' => $absence->overtime_duration,
                'regular_salary' => $regularSalary,
                'overtime_salary' => $overtimeSalary,
                'total_salary' => $totalAbsenceSalary,
                'is_paid' => $absence->is_paid,
                'payment_info' => $absence->payment_info,
            ];

            // Tambahkan ke total gaji
            $totalSalary += $totalAbsenceSalary;
        }

        return view('employees.show', compact('employee', 'absencesWithSalary', 'totalSalary'));
    }

    public function markAllAsPayment($id)
    {

        $absences = Absence::where('employee_id', $id)
            ->where('payment_info', false)
            ->get();

        foreach ($absences as $absence) {
            $absence->update([
                'is_paid' => true,
                'payment_info' => true // Set payment_info to true after payment
            ]);
        }

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('employees.index', $id)->with('success', 'All Paymend done');
    }

    public function markAllAsPaid($id)
    {
        // Ambil karyawan berdasarkan ID
        $employee = Employee::findOrFail($id);

        // Ambil absensi karyawan yang belum dibayar
        $absences = Absence::where('employee_id', $id)
            ->where('is_paid', false)
            ->get();

        // Ubah status semua absensi menjadi "Paid"
        foreach ($absences as $absence) {
            $absence->is_paid = true;
            $absence->save();
        }

        // Redirect kembali ke halaman detail karyawan
        return redirect()->route('employees.show', $employee->id)->with('success', 'All unpaid absences marked as paid and ready for printing.');
    }

    // Menampilkan form untuk mengedit karyawan
    public function edit($id)
    {

        $employee = Employee::findOrFail($id);
        return view('employees.create', compact('employee'));
    }

    // Memperbarui data karyawan

    public function update(Request $request, $id)
    {

        $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id . '|max:255',
            'position' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
            'overtime_wage' => 'required|numeric|min:0',
        ]);

        $employee->update($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    // Menghapus karyawan
    public function destroy(Employee $id)
    {
        $id->delete();
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus.');
    }

    public function deleteAll()
    {

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate both tables
        DB::table('absences')->truncate();
        DB::table('employees')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('employees.index')->with('success', 'All employees and their absences have been deleted successfully.');
    }
}
