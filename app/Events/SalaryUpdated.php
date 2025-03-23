<?php

namespace App\Events;

use App\Models\Employee;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalaryUpdated
{
    use Dispatchable, SerializesModels;

    public Employee $employee;
    public int $oldSalary;
    public int $newSalary;

    public function __construct(Employee $employee, int $oldSalary, int $newSalary)
    {
        $this->employee = $employee;
        $this->oldSalary = $oldSalary;
        $this->newSalary = $newSalary;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
