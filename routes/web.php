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
        Route::get('/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees.edit');
        Route::get('/{employee}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employees.show');
        Route::delete('/{employee}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees.destroy');
    });
});
