<?php

namespace Tests\Unit;

use App\Models\Employee;
use App\Models\Organization;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase; 
    public function test_organization_creation()
    {
        $organization = Organization::factory()->create([
            'name' => 'Tech Solutions Ltd.',
        ]);

        $this->assertDatabaseHas('organizations', [
            'name' => 'Tech Solutions Ltd.',
        ]);
    }

    public function test_organization_requires_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Organization::create([]); // Should fail due to missing name
    }

    public function test_organization_has_teams()
    {
        $organization = Organization::factory()->create();
        $team = Team::factory()->create(['organization_id' => $organization->id]);

        $this->assertTrue($organization->teams->contains($team));
        $this->assertEquals(1, $organization->teams->count());
    }

    public function test_organization_has_employees_through_teams()
    {
        $organization = Organization::factory()->create();
        $team = Team::factory()->create(['organization_id' => $organization->id]);
        $employee = Employee::factory()->create(['team_id' => $team->id]);

        $this->assertTrue($organization->employees->contains($employee));
        $this->assertEquals(1, $organization->employees->count());
    }
}
