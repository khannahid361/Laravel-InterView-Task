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

    public int $employeeId;
    public float $oldSalary;
    public float $newSalary;

    public function __construct(int $employeeId, float $oldSalary, float $newSalary)
    {
        $this->employeeId = $employeeId;
        $this->oldSalary = $oldSalary;
        $this->newSalary = $newSalary;
    }

    // public function broadcastOn(): array
    // {
    //     return [
    //         new PrivateChannel('channel-name'),
    //     ];
    // }
}
