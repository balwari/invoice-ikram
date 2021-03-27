<?php

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


Auth::routes();


Route::get('/', 'App\Http\Controllers\AdminController@index')->name('all');

Route::any('/add-employee', 'App\Http\Controllers\EmployeeController@index')->name('add-employee');

Route::get('get-state-list','App\Http\Controllers\EmployeeController@getStateList');
Route::get('get-designation-list','App\Http\Controllers\EmployeeController@getDesignationList');

Route::post('/create-employee', 'App\Http\Controllers\EmployeeController@create')->name('create-employee');

Route::get('/get-employees', 'App\Http\Controllers\EmployeeController@report')->name('get-employees');

Route::post('/report', 'App\Http\Controllers\EmployeeController@report')->name('report');

