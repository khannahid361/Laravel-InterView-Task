<?php

namespace App\Listeners;

use App\Events\SalaryUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSalaryUpdate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(SalaryUpdated $event)
    {
        Log::info("Salary updated for Employee ID {$event->employeeId}: 
                   Old Salary: {$event->oldSalary}, 
                   New Salary: {$event->newSalary}");
    }
}
