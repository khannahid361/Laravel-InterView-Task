<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateEmployeeReport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MyVendor\PdfReports\ReportGenerator;

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

    public function download()
    {
        $usermail = 'khn36110@gmail.com';

        // Dispatch the job to generate the report and send the email
        GenerateEmployeeReport::dispatch($usermail);

        return response()->json(['message' => 'Report generation started. You will receive an email once it\'s done.']);
    }
    
}
