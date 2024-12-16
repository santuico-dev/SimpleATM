<?php

use App\Http\Controllers\ATMController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
***************************
  DEFAULT MIDDLEWARE
***************************
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
***************************
  AUTHENTICATION ROUTES
***************************
*/

Route::controller(AuthController::class)->group(function () {

    // get routes
    Route::get('/fetchAllUsers', 'fetchAllUsers');

    // post routes
    Route::post('/registerAccount', 'registerAccount');
    Route::post('/loginAccount', 'loginAccount');
});

/*
***************************
  ATM MAIN FUNCTIONALITIES
***************************
*/

Route::controller(ATMController::class)->group(function () {

    // get routes

    // post routes
    Route::post('/withdraw', 'withdraw');
    Route::post('/deposit', 'deposit');
});
