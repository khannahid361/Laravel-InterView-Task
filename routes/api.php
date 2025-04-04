<?php

use App\Http\Controllers\API\Auth\loginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmployeeImportController;
use App\Http\Controllers\API\OrganizationController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\TeamController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [loginController::class, '__invoke']);
Route::post('/auth/logout', [LogoutController::class, '__invoke']);
Route::get('/report', [ReportController::class, 'generateReport']);
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    }); // testing purpose


    Route::prefix('organization')->group(function () {
        Route::get('/', [OrganizationController::class, 'index']);
        Route::middleware(['permission'])->group(function () {
            Route::get('/view/{id}', [OrganizationController::class, 'show']);
            Route::post('/store', [OrganizationController::class, 'store']);
            Route::post('/update', [OrganizationController::class, 'update']);
            Route::post('/delete', [OrganizationController::class, 'delete']);
        });
    });

    //team
    Route::prefix('team')->group(function () {
        Route::get('/', [TeamController::class, 'index']);
        Route::middleware(['permission'])->group(function () {
            Route::get('/view/{id}', [TeamController::class, 'show']);
            Route::post('/store', [TeamController::class, 'store']);
            Route::post('/update', [TeamController::class, 'update']);
            Route::post('/delete', [TeamController::class, 'delete']);
        });
    });

    //employee
    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::middleware(['permission'])->group(function () {
            Route::get('/view/{id}', [EmployeeController::class, 'show']);
            Route::post('/store', [EmployeeController::class, 'store']);
            Route::post('/update', [EmployeeController::class, 'update']);
            Route::post('/delete', [EmployeeController::class, 'delete']);
            Route::post('/filter', [EmployeeController::class, 'filterEmployee']);
            Route::post('/import', [EmployeeImportController::class, 'import']);
        });
    });
});

Route::get('/employee-report', [ReportController::class,'download']);