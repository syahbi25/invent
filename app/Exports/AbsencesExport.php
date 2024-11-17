<?php

namespace App\Exports;

use App\Models\Absence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsencesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Get the collection of absences.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Absence::with('employee')->get(); // Include employee relationship if needed
    }

    /**
     * Define the headings for the export file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Tanggal',
            'Mulai Kerja',
            'Pulang Kerja',
            'Lembur',
            'Kehadiran',
        ];
    }

    /**
     * Map the data for each row in the export.
     *
     * @param Absence $absence
     * @return array
     */
    public function map($absence): array
    {
        return [
            $absence->id,
            $absence->employee->name,
            $absence->absence_date,
            $absence->start_time,
            $absence->end_time,
            $absence->overtime_duration,
            $absence->reason,
        ];
    }
}
