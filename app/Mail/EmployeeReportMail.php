<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;


    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }


    public function build()
    {
        return $this->subject('Employee Report')
                    ->attachData($this->pdf->output(), 'employee-report.pdf', [
                        'mime' => 'application/pdf',
                    ])
                    ->view('emails.employee_report');
    }
}
