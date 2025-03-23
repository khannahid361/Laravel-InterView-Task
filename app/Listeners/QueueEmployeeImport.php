<?php

namespace App\Listeners;

use App\Events\EmployeeDataImported;
use App\Jobs\ProcessEmployeeImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class QueueEmployeeImport
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmployeeDataImported $event)
    {
        ProcessEmployeeImport::dispatch($event->employees);
    }
}
