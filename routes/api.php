<?php

use App\Http\Controllers\API\Auth\loginController;
use App\Http\Controllers\API\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login',[loginController::class, '__invoke']);
Route::post('/auth/logout',[LogoutController::class, '__invoke']);
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    }); // testing purpose

    Route::prefix('organizations')->group(function () {
        
    });
});
