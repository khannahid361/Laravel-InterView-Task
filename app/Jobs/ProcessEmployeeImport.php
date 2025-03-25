<?php

namespace App\Jobs;

use App\Events\EmployeeDataImported;
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
        $total = count($this->employees);
        $processed = 0;
        foreach ($this->employees as $data) {
            try {
                Employee::create([
                    'team_id' => $data['team_id'],
                    'name' => $data['name'],
                    'start_date' => $data['start_date'],
                    'salary' => $data['salary'],
                ]);
                $processed++;
            } catch (\Exception $e) {
                Log::error("Employee Import Error: " . $e->getMessage());
            }
        }

        Notification::route('mail', 'hadi24x7@gmail.com') //hadi24x7@gmail.com
            ->notify(new ImportCompletedNotification($total, $processed));
    }
}
