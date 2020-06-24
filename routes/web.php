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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@userlogout')->name('user.logout');
// Route::get('/admin', 'AdminController@index')->name('home');

Route::prefix('admin')->group(function(){

    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

Route::prefix('lab')->group(function(){

    Route::get('/', 'LaboratoryController@index')->name('lab.dashboard');
    Route::get('/login', 'Auth\LaboratoryLoginController@showLoginForm')->name('lab.login');
    Route::post('/login', 'Auth\LaboratoryLoginController@login')->name('lab.login.submit');
    Route::get('/logout', 'Auth\LaboratoryLoginController@logout')->name('lab.logout');
});

Route::resource('lab/counts','Labs\CD4countController');
Route::resource('doctor/medications','Doctors\MedicationsController');
Route::resource('doctors/reports','Doctors\ReportsController');
Route::resource('nurses/weights','Nurses\WeightsController');


Route::get('nurses/smshistory','Nurses\SMSLogController@Alllogs')->name('sms.log');

Route::get('nurses/today', 'Nurses\SMSLogController@todayslog')->name('sms.todaystats');

Route::resource('nurses/todaylog', 'Nurses\SMSLogController', ['parameters' => [
    'todaylog' => 'id'
]]);
Route::post('nurses/smsresend', 'Nurses\ResendController@resendsms')->name('sms.resend');
 


Route::get('nurses/patient/delete/{id}', 'Nurses\PatientController@delete')->name('patient.delete');

Route::resource('nurses/patient','Nurses\PatientController');
Route::post('nurses/usersupport', 'Nurses\SupportController@supportsms')->name('user.support');
Route::post('nurses/testresults', 'Nurses\TestResultsSMSController@testresults')->name('sms.testresults');
Route::post('nurses/appointment', 'Nurses\AppointmentController@store')->name('sms.appointment');
Route::resource('nurses/tracepatient', 'Nurses\TraceSMSController', ['parameters' => [
    'tracepatient' => 'patient_id'
]]);

Route::resource('nurses/patient', 'Nurses\PatientController', ['parameters' => [
    'patient' => 'id'
]]);