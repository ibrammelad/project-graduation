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
Route::group(['middleware'=>'auth:sanctum' , 'prefix' => 'users'] , function (){

    ///////////////////// logout /////////////////////
    Route::get('/logout' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'logout']);
    ////////////////////////// end logout //////////////////////

    /// ////////////////// manage Controller /////////////////////////////////////////
    Route::patch('/showEmail',[\App\Http\Controllers\API\User\ManageUserController::class , 'showEmail']);
    Route::patch('/showName',[\App\Http\Controllers\API\User\ManageUserController::class , 'showName']);
    Route::patch('/showNearly',[\App\Http\Controllers\API\User\ManageUserController::class , 'showNearly']);
    Route::patch('/HaveCovid19',[\App\Http\Controllers\API\User\ManageUserController::class , 'HaveCovid19']);
    Route::patch('/HelpUsers',[\App\Http\Controllers\API\User\ManageUserController::class , 'HelpUsers']);
    //////////////////////////////// end manage Controllers /////////////////////////

    /////////////////////// doctor Controller ///////////////////////////////
    Route::post('/makeMeDoctor' , [\App\Http\Controllers\API\User\DoctorController::class , 'makeMeDoctor']) ;
    Route::post('/makeMeNurse' , [\App\Http\Controllers\API\User\NurseController::class , 'makeMeNurse']) ;
    ////////////////////////  end doctor Controlller /////////////////////////
});


Route::group(['middleware'=>'auth:sanctum' ] , function () {

///////////// ////////  user controllers  ///////////////////////
    Route::apiResource('users', \App\Http\Controllers\API\User\UserController::class)->except('store', 'destroy');
    Route::get('doctors', [\App\Http\Controllers\API\User\DoctorController::class,'allDoctors']);
    Route::get('nurses', [\App\Http\Controllers\API\User\NurseController::class,'allNurses']);
    Route::apiResource('posts', \App\Http\Controllers\API\Post\PostController::class);
///////////////////////// end user controller /////////////////////////////
});
