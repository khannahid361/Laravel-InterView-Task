<?php

namespace MyVendor\PdfReports;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

class ReportGenerator
{
    public function generate($employees)
    {
        $pdf = Pdf::loadView('pdf.report', compact('employees'));
        return $pdf->download('employee-report.pdf');
    }
}