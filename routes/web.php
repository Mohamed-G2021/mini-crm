<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Employee\CustomerController as EmployeeCustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('customers', CustomerController::class);
    });

Route::middleware(['auth', 'role:employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::resource('customers', EmployeeCustomerController::class);
    Route::get('actions/create/{customer}', [\App\Http\Controllers\Employee\ActionController::class, 'create'])->name('actions.create');
    Route::post('actions', [\App\Http\Controllers\Employee\ActionController::class, 'store'])->name('actions.store');
    Route::get('actions/{customer}', [\App\Http\Controllers\Employee\ActionController::class, 'index'])->name('actions.index');
});