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

    public static function boot()
    {
        parent::boot();
    
        static::updating(function ($employee) {
            if ($employee->isDirty('salary')) {
                dd('Event is being fired for employee:', $employee->id, $employee->getOriginal('salary'), $employee->salary);
                event(new SalaryUpdated(
                    $employee->id,  
                    (float) $employee->getOriginal('salary'),  
                    (float) $employee->salary
                ));
            }
        });
    }

    // protected $dispatchesEvents = [
    //     'updated' => SalaryUpdated::class,
    // ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeStartedAfter($query, $date)
    {
        return $query->where('start_date', '>=', $date);
    }
}
