<?php

namespace MyVendor\PdfReports;

use App\Mail\EmployeeReportMail;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class ReportGenerator
{
    public function oldgenerate($employees)
    {
        $pdf = Pdf::loadView('pdf.report', compact('employees'));
        return $pdf->download('employee-report.pdf');
    }
    public function generateAndSendReport($userMail)
    {
        $employeeData = '';

        Employee::chunk(100, function ($employees) use (&$employeeData) {
            $employeeData .= view('pdf.report', compact('employees'))->render();
        });

        $pdf = Pdf::loadHTML($employeeData);

        Mail::to($userMail)->send(new EmployeeReportMail($pdf));
    }
}