<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Organization;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_calculates_correctly()
    {
        $organization = Organization::factory()->create();

        $team1 = Team::factory()->create(['organization_id' => $organization->id]);
        $team2 = Team::factory()->create(['organization_id' => $organization->id]);

        Employee::factory()->create(['team_id' => $team1->id, 'salary' => 50000]);
        Employee::factory()->create(['team_id' => $team1->id, 'salary' => 60000]);
        Employee::factory()->create(['team_id' => $team2->id, 'salary' => 70000]);
        Employee::factory()->create(['team_id' => $team2->id, 'salary' => 80000]);

        $response = $this->getJson('/api/report');

        $response->dump();

        $response->assertStatus(200)
            ->assertJsonStructure([
                'teamBasedReport' => [
                    '*' => ['team_id', 'total_employees', 'avg_salary']
                ],
                'organizationBasedReport' => [
                    '*' => ['id', 'name', 'total_employees']
                ]
            ]);
    }
}
