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
Route::post("/userregister","UserController@userRegister");
Route::post("/userlogin","UserController@userLogin");
Route::post("/getasset","UserController@getAssets");
Route::post("/gettopuser","UserController@getTopUers");
Route::post("/getquestionset","UserController@getQuestionSet");
Auth::routes();
Route::post('/reducepoints', "DashboardController@reducePoints");