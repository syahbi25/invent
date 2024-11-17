<?php

namespace App\Imports;

use App\Models\Absence;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsencesImport implements ToModel, WithHeadingRow
{
    /**
     * Convert the row into an Absence model instance.
     *
     * @param array $row
     * @return Absence|null
     */
    public function model(array $row)
    {
        // Find the employee ID based on the employee name in the row
        $employee = Employee::where('name', $row['nama'])->first();

        // If employee not found, skip this row
        if (!$employee) {
            return null;
        }

        // Handle the date format based on whether it's a number (Excel date serial) or a valid date string
        if (is_numeric($row['tanggal'])) {
            // Convert Excel serial number to a date
            $absenceDate = Carbon::createFromFormat('Y-m-d', gmdate('Y-m-d', ($row['tanggal'] - 25569) * 86400));
        } else {
            // Parse date directly if it’s in a valid string format
            try {
                $absenceDate = Carbon::parse($row['tanggal'])->format('Y-m-d');
            } catch (\Exception $e) {
                return null; // Skip row if date parsing fails
            }
        }

        // Return a new Absence instance with the found employee ID
        return new Absence([
            'employee_id'       => $employee->id,
            'absence_date'      => $absenceDate,
            'start_time'        => $row['mulai_kerja'],
            'end_time'          => $row['pulang_kerja'],
            'overtime_duration' => $row['lembur'],
            'reason'            => $row['kehadiran'],
        ]);
    }
}
