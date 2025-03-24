<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function () {
    Mail::raw('This is a test email from Laravel!', function ($message) {
        $message->to('hadi24x7@gmail.com') // Change to your email
                ->subject('Laravel Test Email');
    });

    return 'Test email sent!';
});