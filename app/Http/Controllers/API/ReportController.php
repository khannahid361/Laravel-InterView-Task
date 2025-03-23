<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function generateReport()
    {
        $teamBasedReport = DB::table('employees')
            ->selectRaw('team_id, COUNT(id) as total_employees, AVG(salary) as avg_salary')
            ->groupBy('team_id')
            ->get();

        $organizationBasedReport = DB::table('employees as e')
            ->join('teams as t', 'e.team_id', '=', 't.id')
            ->join('organizations as o', 't.organization_id', '=', 'o.id')
            ->selectRaw('o.id, o.name, COUNT(e.id) as total_employees')
            ->groupBy('o.id', 'o.name')
            ->get();

        return response()->json([
            'teamBasedReport' => $teamBasedReport,
            'organizationBasedReport' => $organizationBasedReport
        ]);
    }
}
