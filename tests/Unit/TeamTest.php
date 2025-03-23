<?php

namespace Tests\Unit;

use App\Models\Employee;
use App\Models\Organization;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase; // Ensures a clean DB for each test

    public function test_team_creation()
    {
        $organization = Organization::factory()->create();

        $team = Team::factory()->create([
            'organization_id' => $organization->id,
            'name' => 'Development Team',
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Development Team',
            'organization_id' => $organization->id,
        ]);
    }

    public function test_team_requires_name_and_organization()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Team::create([]); // Should fail due to missing required fields
    }

    public function test_team_belongs_to_organization()
    {
        $organization = Organization::factory()->create();
        $team = Team::factory()->create(['organization_id' => $organization->id]);

        $this->assertEquals($organization->id, $team->organization->id);
    }

    public function test_team_has_employees()
    {
        $team = Team::factory()->create();
        $employee = Employee::factory()->create(['team_id' => $team->id]);

        $this->assertTrue($team->employees->contains($employee));
        $this->assertEquals(1, $team->employees->count());
    }
}
