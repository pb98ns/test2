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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/vacations', [App\Http\Controllers\VacationController::class, 'index'])->name('vacationindex');
Route::get('/home/vacations_reports', [App\Http\Controllers\VacationController::class, 'index2'])->name('vacationreport');
Route::get('/index2', [App\Http\Controllers\HomeController::class, 'index2'])->name('index2');
Route::post('/home1', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
Route::get('/home/customers', [App\Http\Controllers\FirmController::class, 'index'])->name('company');
Route::post('/home/customers', 'FirmController@store');
Route::post('/home/vacations', 'VacationController@store');
Route::get('/home/customers/edit/{id}', 'FirmController@edit');
Route::patch('/home/customers/update/{id}', 'FirmController@update');
Route::delete('/home/customers/delete/{id}', 'FirmController@delete');
Route::get('register', [App\Http\Controllers\UserController::class, 'index'])->name('register');
Route::delete('/home/users/delete/{id}', 'UserController@delete');
Route::get('/home/users/edit/{id}', 'UserController@edit');
Route::patch('/home/users/update/{id}', 'UserController@update');
Route::get('/home/reports', [App\Http\Controllers\ProjectController::class, 'index'])->name('reports');
Route::get('/home/day_reports', [App\Http\Controllers\ProjectController::class, 'index2'])->name('reports2');
Route::get('/home/period_reports', [App\Http\Controllers\ProjectController::class, 'period2'])->name('period2');
Route::post('/home/reports', 'ProjectController@search')->name('search');
Route::post('/home/day_reports', 'ProjectController@searchday')->name('searchday');
Route::post('/home/vacations_reports', 'VacationController@searchday')->name('searchdayvacation');
Route::post('/home/vacations_reports_period', 'VacationController@searchperiod')->name('searchperiod');
Route::post('/home', 'HomeController@searchday2')->name('searchday2');
Route::post('/home/searchvacations', 'VacationController@searchvacation')->name('searchvacation');
Route::post('/home/period_reports', 'ProjectController@searchperiod')->name('searchperiod');
Route::get('/home/reports/edit/{id}', 'ProjectController@edit');
Route::get('/home/reports/show/{id}', 'ProjectController@show');
Route::get('/home/reports/user_show_day/{id}', 'ProjectController@show2');
Route::get('/home/vacations/user_show_vacations/{id}', 'VacationController@show2');
Route::get('/home/vacations/user_show_vacations_ch/{id}', 'VacationController@show4');
Route::delete('/home/vacations/delete/{id}', 'VacationController@delete');
Route::get('/home/reports/customer_show_day/{id}', 'ProjectController@show3');
Route::get('/home/reports/user_show_period/{id}', 'ProjectController@show4');
Route::get('/home/reports/customer_show_period/{id}', 'ProjectController@show5');
Route::get('/home/reports/message/{id}', 'ProjectController@message');
Route::patch('/home/reports/update/{id}', 'ProjectController@update');
Route::delete('/home/report/delete/{id}', 'ProjectController@delete');
Route::delete('/home/delete/{id}', 'ProjectController@delete2');
Route::get('/home/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
Route::post('/home/tasks', 'TaskController@store');
Route::get('/home/tasks/edit/{id}', 'TaskController@edit');
Route::patch('/home/tasks/update/{id}', 'TaskController@update');
Route::delete('/home/tasks/delete/{id}', 'TaskController@delete');