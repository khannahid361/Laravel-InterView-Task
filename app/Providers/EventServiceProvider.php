<?php

namespace App\Providers;

use App\Events\EmployeeDataImported;
use App\Events\SalaryUpdated;
use App\Listeners\LogSalaryUpdate;
use App\Listeners\QueueEmployeeImport;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        EmployeeDataImported::class => [
            QueueEmployeeImport::class,
        ],
        SalaryUpdated::class => [
            LogSalaryUpdate::class,
        ],
    ];

    
    public function boot(): void
    {
        //
    }

    
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
