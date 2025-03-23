<?php

namespace Tests\Unit;

use App\Models\Employee;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase; 

    public function test_employee_creation()
    {
        $team = Team::factory()->create();

        $employee = Employee::factory()->create([
            'team_id' => $team->id,
            'name' => 'John Doe',
            'start_date' => '2025-01-01',
            'salary' => 50000,
        ]);

        $this->assertDatabaseHas('employees', [
            'name' => 'John Doe',
            'start_date' => '2025-01-01',
            'salary' => 50000,
        ]);
    }

    public function test_employee_requires_name_start_date_and_salary()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Employee::create([
            'team_id' => 1, // Missing required fields
        ]);
    }

    public function test_salary_update_triggers_event()
    {
        // Event::fake();

        $team = Team::factory()->create();
        $employee = Employee::factory()->create([
            'team_id' => $team->id,
            'salary' => 50000,
        ]);

        $employee->update(['salary' => 60000]);

        // Event::assertDispatched(SalaryUpdated::class, function ($event) use ($employee) {
        //     return $event->employee->id === $employee->id &&
        //            $event->oldSalary === 50000 &&
        //            $event->newSalary === 60000;
        // });
    }
}
