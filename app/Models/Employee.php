<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'position', 'grade', 'fee', 'overtime_wage',];

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
}
