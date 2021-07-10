<?php

use Illuminate\Support\Facades\Route;






/////////////////////// register and login route /////////////////////////////
Route::prefix('users' )->group(function (){
    Route::post('login' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'login']);
    Route::post('loginWith' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'loginWith']);
    Route::post('register' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'register']);
    Route::post('registerWith' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'registerWith']);
    Route::post('forgot-password', [\App\Http\Controllers\API\Regesiter\PasswordController::class , 'forgot_password']);

});
/////////////////////// register and login route /////////////////////////////


/////////////////////////// user routes  ////////////////////////////////////////////////
Route::group(['middleware'=>'auth:sanctum' , 'prefix' => 'users'] , function (){

    /////////////////////// verification  /////////////////////////////
    Route::post('verify' ,[\App\Http\Controllers\API\Regesiter\VerifyController::class , 'verify']);
    Route::post('verify-password', [\App\Http\Controllers\API\Regesiter\PasswordController::class , 'verify_pass']);
    //////////////////////    end       ////////////////////////////////////////

    Route::post('update-password', [\App\Http\Controllers\API\Regesiter\updatePassword::class , 'updatePassword']);


    ///////////////////// logout /////////////////////
    Route::get('/logout' , [\App\Http\Controllers\API\Regesiter\LoginController::class , 'logout']);
    ////////////////////////// end logout //////////////////////

    /// ////////////////// manage Controller /////////////////////////////////////////
    Route::post('/showEmail',[\App\Http\Controllers\API\User\ManageUserController::class , 'showEmail']);
    Route::post('/showName',[\App\Http\Controllers\API\User\ManageUserController::class , 'showName']);
    Route::post('/showNearly',[\App\Http\Controllers\API\User\ManageUserController::class , 'showNearly']);
    Route::post('/HaveCovid19',[\App\Http\Controllers\API\User\ManageUserController::class , 'HaveCovid19']);
    Route::post('/susbected19',[\App\Http\Controllers\API\User\ManageUserController::class , 'susbected19']);
    Route::post('/symptoms19',[\App\Http\Controllers\API\User\ManageUserController::class , 'symptoms19']);
    Route::post('/HelpUsers',[\App\Http\Controllers\API\User\ManageUserController::class , 'HelpUsers']);
    Route::get('/allHelper',[\App\Http\Controllers\API\User\ManageUserController::class , 'allHelper']);
    Route::get('/settings',[\App\Http\Controllers\API\User\ManageUserController::class , 'settings']);
    Route::get('/nearlyPeoples',[\App\Http\Controllers\API\User\ManageUserController::class , 'nearlyPeoples']);
    //////////////////////////////// end manage Controllers /////////////////////////

    ///////////////////////////////////// fcmToken .////////////////////////////////////////////
    Route::post('FCMToken', [\App\Http\Controllers\API\User\ManageUserController::class ,'postToken']);
    ///////////////////////////////////// fcmToken .////////////////////////////////////////////


    ///////////////////////////////// store location of peoples //////////////////
    Route::post('/updateLocation' , [\App\Http\Controllers\API\Location\PeopleLocationController::class , 'updateLocation']) ;
    ///////////////////////////////// end store location of peoples //////////////////

    /////////////////////// doctor Controller ///////////////////////////////
    Route::post('/makeMeDoctor' , [\App\Http\Controllers\API\User\DoctorController::class , 'makeMeDoctor']) ;
    Route::post('/makeMeNurse' , [\App\Http\Controllers\API\User\NurseController::class , 'makeMeNurse']) ;
    ////////////////////////  end doctor Controlller /////////////////////////

});


Route::group(['middleware'=>'auth:sanctum' ] , function () {

    ///////////// ////////  user controllers  ///////////////////////
    Route::get('users' , [\App\Http\Controllers\API\User\UserController::class ,'index']);
    Route::post('users/modify' , [\App\Http\Controllers\API\User\UserController::class ,'update']);
    Route::post('users/upLoadAvt' , [\App\Http\Controllers\API\User\UserController::class ,'upload']);

    Route::get('users/{id}' , [\App\Http\Controllers\API\User\UserController::class ,'show']);
    Route::get('doctors', [\App\Http\Controllers\API\User\DoctorController::class,'allDoctors']);
    Route::get('nurses', [\App\Http\Controllers\API\User\NurseController::class,'allNurses']);
    ///////////// ////////  end user controllers  ///////////////////////




    /////////////////////////// posts ////////////////////////////////////////////////////
    Route::get('posts' , [\App\Http\Controllers\API\Post\PostController::class ,'index']);
    Route::post('posts/' , [\App\Http\Controllers\API\Post\PostController::class ,'store']);
    Route::post('posts/{id}' , [\App\Http\Controllers\API\Post\PostController::class ,'update']);
    Route::post('posts/{id}/delete' , [\App\Http\Controllers\API\Post\PostController::class ,'destroy']);
    /////////////////////////////////////// end posts ///////////////////////////////////////////////

    /////////////////////////////////////// change password ///////////////////////////////////////////////
    Route::post('changePass',[\App\Http\Controllers\API\Regesiter\PasswordController::class , 'changePass']);
    /////////////////////////////////////// change password ///////////////////////////////////////////////

    /////////////////////////////////////// comments ///////////////////////////////////////////////
    Route::get('posts/{post}/comments' , [\App\Http\Controllers\API\Post\CommentController::class ,'showAllComment']);
    Route::post('comments/' , [\App\Http\Controllers\API\Post\CommentController::class ,'store']);
    Route::post('comments/{id}' , [\App\Http\Controllers\API\Post\CommentController::class ,'update']);
    Route::post('comments/{id}/delete' , [\App\Http\Controllers\API\Post\CommentController::class ,'destroy']);
    ///////////////////////////////////////end comments ///////////////////////////////////////////////

    /////////////////////////////////////// comments ///////////////////////////////////////////////
    Route::post('likes/' , [\App\Http\Controllers\API\Post\LikeController::class ,'like']);
    Route::post('dislikes/' , [\App\Http\Controllers\API\Post\LikeController::class ,'dislike']);
    Route::get('posts/{id}/islikedbyme', [\App\Http\Controllers\API\Post\LikeController::class,'isLikedByMe']);
    /////////////////////////////////////// end comments ////////////////////////////////////////////////

    /// ////////////////////////////////////// saved ///////////////////////////////////////////////
    Route::post('saved/{id}/delete' , [\App\Http\Controllers\API\Post\SavedController::class ,'destroy']);
    Route::post('posts/{id}/savePost/' , [\App\Http\Controllers\API\Post\SavedController::class ,'savePost']);
    Route::get('mySavedPosts', [\App\Http\Controllers\API\Post\SavedController::class,'mySaved']);
    /////////////////////////////////////// end saved ///////////////////////////////////////////////

    /// ////////////////////////////////////// Hospital ///////////////////////////////////////////////
    Route::get('hospitals', [\App\Http\Controllers\API\Hospital\HospitalController::class,'allHospitals']);
    /// //////////////////////////////////////end Hospital ///////////////////////////////////////////////

    ///////////////////////////////////////////// get notifications //////////////////////////////////////////
    Route::get('/notifications', [\App\Http\Controllers\API\Notification\NotificationController::class,'allNotification']);



});
