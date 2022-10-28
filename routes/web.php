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

/*_______ LANDING _______ */
Route::get('/', function () {
    return view('auth.login');
});

/*_______ AUTH ROUTES _______ */
Auth::routes();

/*_______ DASHBOARD _______ */
Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');

/*_______ RECORDS _______ */
Route::group( ['prefix' => 'records'] ,function () {
    Route::get('/','RecordController@index')->middleware('auth')->name('records');
    Route::get('create', function (){ return view ('record.create'); })->middleware('auth')->name('record.create');
    Route::post('next', 'RecordController@nextStep')->middleware('auth')->name('record.next');
    Route::post('store', 'RecordController@store')->middleware('auth')->name('record.store');
    Route::get('{uuid}', 'RecordController@show')->middleware('auth')->name('record.show');
    Route::get('{uuid}/edit', 'RecordController@edit')->middleware('auth')->name('record.edit');
    Route::post('{uuid}/update', 'RecordController@update')->middleware('auth')->name('record.update');
    Route::post('{uuid}/delete', 'RecordController@destroy')->middleware('auth')->name('record.delete');
});

/*_______ APPOINTMENTS _______ */
Route::group( ['prefix' => 'appointments'] ,function () {
    Route::post('store', 'AppointmentController@store')->middleware('auth')->name('appointment.store');
    Route::get('{id}/edit', 'AppointmentController@edit')->middleware('auth')->name('appointment.edit');
    Route::post('{id}/update', 'AppointmentController@update')->middleware('auth')->name('appointment.update');
    Route::post('{id}/delete', 'AppointmentController@destroy')->middleware('auth')->name('appointment.delete');
});

/*_______ PACIENTS _______ */
Route::get('/patients','PatientController@index')->name('patients')->middleware(['auth', 'role']);