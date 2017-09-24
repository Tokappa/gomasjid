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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function() {
    Route::post('config', 'ApiController@postConfig');
    Route::post('slideshows', 'ApiController@postSlideshows');
    Route::post('financial', 'ApiController@postFinancial');
    Route::post('jumat', 'ApiController@postJumat');
    Route::post('news', 'ApiController@postNews');
});

// Route::post('config', 'ApiController@postConfig');
// Route::post('events', 'ApiController@postEvents');
// Route::post('financial', 'ApiController@postFinancial');
// Route::post('jumat', 'ApiController@postJumat');
// Route::post('news', 'ApiController@postNews');
// Route::post('check-token', 'ApiController@postCheckToken');
// Route::post('device-status', 'ApiController@postDeviceStatus');
