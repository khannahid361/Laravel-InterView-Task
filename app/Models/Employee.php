<?php

namespace App\Models;

use App\Events\SalaryUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'salary',
        'start_date',
        'team_id'
    ];
    protected $table = 'employees';

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeStartedAfter($query, $date)
    {
        return $query->where('start_date', '>=', $date);
    }

    protected static function booted()
    {
        static::updating(function ($employee) {
            if ($employee->isDirty('salary')) {
                event(new SalaryUpdated($employee, $employee->getOriginal('salary'), $employee->salary));
            }
        });
    }
}
