<?php

use Illuminate\Support\Facades\Route;


/////////////////////////// user routes  ////////////////////////////////////////////////
Route::apiResource('users',\App\Http\Controllers\API\User\UserController::class)->except('store' , 'destroy');
Route::patch('/users/{id}/showEmail',[\App\Http\Controllers\API\User\ManageUserController::class , 'showEmail']);
Route::patch('/users/{id}/showName',[\App\Http\Controllers\API\User\ManageUserController::class , 'showName']);
Route::patch('/users/{id}/showNearly',[\App\Http\Controllers\API\User\ManageUserController::class , 'showNearly']);
Route::patch('/users/{id}/HaveCovid19',[\App\Http\Controllers\API\User\ManageUserController::class , 'HaveCovid19']);
Route::patch('/users/{id}/HelpUsers',[\App\Http\Controllers\API\User\ManageUserController::class , 'HelpUsers']);
/////////////////////////// end user routes  /////////////////////////////////////////

//Route::apiResource('doctors'  , \App\Http\Controllers\API\User\DoctorController::class);
