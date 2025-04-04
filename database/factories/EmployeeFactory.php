<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        // i want 10000 data
        
        return [
            'name' => $this->faker->name,
            'salary' => $this->faker->numberBetween(30000, 100000),
            'start_date' => $this->faker->date(), 
            'team_id' => 1, 
            // 'team_id' => Team::factory()->create()->id, 
        ];
    }
}
