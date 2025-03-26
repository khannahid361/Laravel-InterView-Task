<?php

namespace MyVendor\PdfReports;

use Illuminate\Support\ServiceProvider;

class PdfReportsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('pdf-reports', function ($app) {
            return new ReportGenerator();
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'pdf-reports');
    }
}