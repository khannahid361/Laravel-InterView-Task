<?php

use App\Http\Controllers\API\Auth\loginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login',[loginController::class]);
Route::prefix('v1')->group(function () {
});
