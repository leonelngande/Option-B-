<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('help/helper', function () {
    return view('pages.help');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/patient/list', 'PatientController@index')->name('patient-list');

Route::get('/patient/create', 'PatientController@create')->name('create-patient');

Route::post('/patient/store', 'PatientController@store')->name('store-patient');

Route::post('/patient/{patient}', 'PatientController@update')->name('update-patient');

Route::get('/patient/{patient}', 'PatientController@destroy')->name('delete-patient');





Route::get('/appointment/list', 'AppointmentController@index')->name('appointment-list');

Route::post('/appointment/store', 'AppointmentController@store')->name('store-appointment');

Route::post('/appointment/{appointment}', 'AppointmentController@update')->name('update-appointment');

Route::get('/appointment/{appointment}', 'AppointmentController@destroy')->name('delete-appointment');



Route::get('/sms/list', 'SMSController@index')->name('sms-list');

Route::get('/sms/create', 'SMSController@create')->name('create-sms');

Route::post('/sms/store', 'SMSController@store')->name('send-sms');

Route::post('/sms/{msg}', 'SMSController@update')->name('update-sms');

Route::get('/sms/{msg}', 'SMSController@destroy')->name('delete-sms');


