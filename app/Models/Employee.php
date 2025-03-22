<?php

namespace App\Models;

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
}
