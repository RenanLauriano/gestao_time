<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function() {
    recirect('/employee_events');
});
Route::resource('employees', EmployeeController::class);
Route::resource('events', EventController::class);
Route::resource('employee_events', EmployeeEventController::class);
Route::post('/events/generate', 'EmployeeEventController@generateEventForAllEmployees')->name('events.generate');

