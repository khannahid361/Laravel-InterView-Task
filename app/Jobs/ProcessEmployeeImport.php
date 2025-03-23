<?php

namespace App\Jobs;

use App\Models\Employee;
use App\Notifications\ImportCompletedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ProcessEmployeeImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $employees;

    public function __construct(array $employees)
    {
        $this->employees = $employees;
    }

    public function handle()
    {
        foreach ($this->employees as $data) {
            try {
                Employee::create([
                    'team_id' => $data['team_id'],
                    'name' => $data['name'],
                    'start_date' => $data['start_date'],
                    'salary' => $data['salary'],
                ]);
            } catch (\Exception $e) {
                Log::error("Employee Import Error: " . $e->getMessage());
            }
        }

        Notification::route('mail', 'admin@example.com')
            ->notify(new ImportCompletedNotification());
    }
}
