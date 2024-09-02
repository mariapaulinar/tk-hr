<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employees.create');
        Route::get('/{employee}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees.edit');
        Route::delete('/{employee}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees.destroy');
    });
    Route::group(['prefix' => 'costs-reports'], function () {
        Route::get('/import', [App\Http\Controllers\CostsReportController::class, 'import'])->name('costs-reports.import');
        Route::get('/status', [App\Http\Controllers\CostsReportController::class, 'status'])->name('costs-reports.status');
        Route::get('/report', [App\Http\Controllers\CostsReportController::class, 'report'])->name('costs-reports.report');
    });
});
