<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToCollection, ToModel
{
    private $current = 0;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection) {}

    public function model(array $row)
    {
        $this->current++;
        if ($this->current > 1) {
            $employee = new Employee;
            $employee->name = $row[0];
            $employee->email = $row[1];
            $employee->position = $row[2];
            $employee->grade = $row[3];
            $employee->fee = $row[4];
            $employee->overtime_wage = $row[5];
            $employee->save();
        }
    }
}
