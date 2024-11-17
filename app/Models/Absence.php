<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'absence_date',
        'reason',
        'start_time',
        'end_time',
        'overtime_duration',
        'is_paid',
        'payment_info',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getDurationAttribute()
    {
        if ($this->start_time && $this->end_time) {
            // Menghitung selisih waktu
            $startTime = \Carbon\Carbon::parse($this->start_time);
            $endTime = \Carbon\Carbon::parse($this->end_time);
            return $startTime->diffInHours($endTime) . ' Jam';
        }
        return 'N/A'; // Jika waktu tidak ada, kembalikan 'N/A'
    }
}
