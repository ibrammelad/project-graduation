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
Route::get('/admin' ,[\App\Http\Controllers\Web\LoginController::class , 'loginPage'])->name('loginPage');
Route::post('/admin' ,[\App\Http\Controllers\Web\LoginController::class , 'login'])->name('loginPost');

Route::group(['middleware' => 'auth'] , function (){

   ///////////////////////////////////////  have covid  19 /////////////////////////////////////////////////////////////
    Route::get('/i-have-covid' ,[\App\Http\Controllers\Web\HaveCovid::class , 'index'])->name('FirstPage');
    Route::post('/accept/{id}' ,[\App\Http\Controllers\Web\HaveCovid::class , 'accept'])->name('accept');
    Route::post('/refuse/{id}' ,[\App\Http\Controllers\Web\HaveCovid::class , 'refuse'])->name('refuse');
    /////////////////////////////////////// end have covid  19 /////////////////////////////////////////////////////////////

    ///////////////////////////////////////  have susbected covid  19 /////////////////////////////////////////////////////////////
    Route::get('/i-have-Susb' ,[\App\Http\Controllers\Web\HaveCovid::class , 'indexSusb'])->name('susbectedPage');
    Route::post('/acceptSusb/{id}' ,[\App\Http\Controllers\Web\HaveCovid::class , 'acceptSusb'])->name('acceptSusb');
    Route::post('/refuseSusb/{id}' ,[\App\Http\Controllers\Web\HaveCovid::class , 'refuseSusb'])->name('refuseSusb');
    /////////////////////////////////////// end have susbected covid  19 /////////////////////////////////////////////////////////////

    ///////////////////////////////////////  add hospitals  /////////////////////////////////////////////////////////////
    Route::get('/hospital' , [\App\Http\Controllers\Web\HosoitalController::class , 'index'])->name('hospitalPage');
    Route::post('/addHospital' , [\App\Http\Controllers\Web\HosoitalController::class , 'store'])->name('storeHospital');
    /////////////////////////////////////// end  add hospitals  /////////////////////////////////////////////////////////////




    Route::get('/review-doctors' , [\App\Http\Controllers\Web\ReviewDNController::class , 'indexDoctor'])->name('doctorPage');
    Route::post('/acceptDoctor/{id}' ,[\App\Http\Controllers\Web\ReviewDNController::class , 'acceptDoctor'])->name('acceptDoctor');
    Route::post('/refuseDoctor/{id}' ,[\App\Http\Controllers\Web\ReviewDNController::class , 'refuseDoctor'])->name('refuseDoctor');

    Route::get('/review-nurse' , [\App\Http\Controllers\Web\ReviewDNController::class , 'indexNurse'])->name('viewNurse');
    Route::post('/acceptNurse/{id}' ,[\App\Http\Controllers\Web\ReviewDNController::class , 'acceptNurse'])->name('acceptNurse');
    Route::post('/refuseNurse/{id}' ,[\App\Http\Controllers\Web\ReviewDNController::class , 'refuseNurse'])->name('refuseNurse');












});
