<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ResetPasswordController;

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('phone', [AuthController::class,'phone']);
    Route::post('laptop', [AuthController::class,'laptop']);
    Route::post('vehicle', [AuthController::class,'vehicle']);
    Route::post('home', [AuthController::class,'home']);
    Route::post('me', [AuthController::class,'me']);
    Route::post('sendPasswordResetLink', [ResetPasswordController::class,'sendEmail']);
    Route::post('resetPassword', [ChangePasswordController::class,'process']);

});

