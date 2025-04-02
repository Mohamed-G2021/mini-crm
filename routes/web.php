<?php

use App\Http\Controllers\Admin\CustomerAssignmentController;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('assignments', CustomerAssignmentController::class);
    });