<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//list of patients
Route::get('patients', 'Nurses\PatientController@index');
//list one patient
Route::get('patient/{id}','Nurses\PatientController@show');
//create new
Route::post('patient','Nurses\PatientController@store');
//update
Route::put('patient','Nurses\PatientController@store');
//delete
Route::delete('patient/{id}','Nurses\PatientController@destroy');
