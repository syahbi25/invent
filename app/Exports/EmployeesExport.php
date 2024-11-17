<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Employee::select('*')->get();
    }

    public function map($employee): array
    {
        return [
            $employee->name,
            $employee->email,
            $employee->position,
            $employee->grade,
            $employee->fee,
            $employee->overtime_wage,
        ];
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Position', 'Grade', 'Fee', 'Overtime Wage'];
    }
}
