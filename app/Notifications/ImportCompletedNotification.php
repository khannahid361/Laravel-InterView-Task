<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportCompletedNotification extends Notification
{
    use Queueable;

    protected int $totalEmployees;
    protected int $processedEmployees;

    public function __construct(int $totalEmployees, int $processedEmployees)
    {
        $this->totalEmployees = $totalEmployees;
        $this->processedEmployees = $processedEmployees;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Employee Import Completed')
        ->greeting('Hello Admin,')
        ->line("The employee import process has completed.")
        ->line("Total Employees: **{$this->totalEmployees}**")
        ->line("Successfully Processed: **{$this->processedEmployees}**")
        ->line("Failed Imports: **" . ($this->totalEmployees - $this->processedEmployees) . "**")
        ->line('Check the logs for any errors.')
        ->line('Thank you!');
    }
}
