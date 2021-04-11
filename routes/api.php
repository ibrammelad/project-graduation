<?php

use Illuminate\Support\Facades\Route;





/////////////////////// register and login route /////////////////////////////
Route::prefix('users' )->group(function (){
    Route::post('login' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'login']);
    Route::post('loginWith' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'loginWith']);
    Route::post('register' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'register']);
    Route::post('registerWith' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'registerWith']);
});

//////////////////////    end       ////////////////////////////////////////

/////////////////////////// user routes  ////////////////////////////////////////////////
Route::group(['middleware'=>'auth:sanctum'] , function (){
    Route::get('/users/logout' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'logout']);
    Route::apiResource('users',\App\Http\Controllers\API\User\UserController::class)->except('store' , 'destroy');
    Route::patch('/users/{id}/showEmail',[\App\Http\Controllers\API\User\ManageUserController::class , 'showEmail']);
    Route::patch('/users/{id}/showName',[\App\Http\Controllers\API\User\ManageUserController::class , 'showName']);
    Route::patch('/users/{id}/showNearly',[\App\Http\Controllers\API\User\ManageUserController::class , 'showNearly']);
    Route::patch('/users/{id}/HaveCovid19',[\App\Http\Controllers\API\User\ManageUserController::class , 'HaveCovid19']);
    Route::patch('/users/{id}/HelpUsers',[\App\Http\Controllers\API\User\ManageUserController::class , 'HelpUsers']);

});


/////////////////////////// end user routes  /////////////////////////////////////////

//Route::apiResource('doctors'  , \App\Http\Controllers\API\User\DoctorController::class);
