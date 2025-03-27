<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MyVendor\PdfReports\ReportGenerator;

class GenerateEmployeeReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userMail;

    public function __construct($userMail)
    {
        $this->userMail = $userMail;
    }


    public function handle()
    {
        $reportGenerator = new ReportGenerator();
        $reportGenerator->generateAndSendReport($this->userMail);
    }
}
