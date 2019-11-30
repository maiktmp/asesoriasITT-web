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

Route::post(
    'login',
    'Api\ApiController@login'
);

Route::post(
    'user/create',
    'Api\ApiController@userCreate'
);

Route::get(
    'get_all_users/{userType}/',
    'Api\ApiController@getAllUserType'
);

Route::get(
    'user/{userId}/',
    'Api\ApiController@getUserDetail'
);
Route::get(
    'advisories/search/',
    'Api\ApiController@searchAdvisory'
);

Route::post(
    'user/{userId}/create_advisory',
    'Api\ApiController@upserAdvisory'
);


Route::post(
    'user/{userId}/update',
    'Api\ApiController@updateUser'
);


