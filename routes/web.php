<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// User activation
Route::get('/user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');


// User
Route::get('/user', 'UserController@index')->name('user.list');
Route::get('/user/search', 'UserController@search')->name('user.search');
Route::get('/user/{user_id}', 'UserController@show')->name('user.profile');
Route::post('/user', 'UserController@store')->name('user.add');
Route::post('/user/delete', 'UserController@destroy')->name('user.delete');
Route::post('/user/update', 'UserController@update')->name('user.update');


// Gallery
Route::get('/gallery', 'GalleryController@index')->name('gallery.list');
// Route::get('/gallery/search', 'GalleryController@search')->name('gallery.search');
// Route::get('/gallery/{gallery_id}', 'GalleryController@show')->name('gallery.profile');
Route::post('/gallery', 'GalleryController@store')->name('gallery.add');
Route::post('/gallery/delete', 'GalleryController@destroy')->name('gallery.delete');
// Route::post('/gallery/update', 'GalleryController@update')->name('gallery.update');


// Schedule
Route::get('/schedule', 'ScheduleController@index')->name('schedule.list');
Route::get('/schedule/active', 'ScheduleController@getActive')->name('schedule.list-active');
// Route::get('/schedule/search', 'ScheduleController@search')->name('schedule.search');
Route::get('/schedule/{schedule_id}', 'ScheduleController@show')->name('schedule.detail');
Route::post('/schedule', 'ScheduleController@store')->name('schedule.add');
Route::post('/schedule/delete', 'ScheduleController@destroy')->name('schedule.delete');
Route::post('/schedule/update', 'ScheduleController@update')->name('schedule.update');


// Masjid
Route::get('/shalat-time', 'MasjidController@indexShalat')->name('shalat.list');
Route::post('/shalat-time', 'MasjidController@storeShalat')->name('shalat.update');
Route::get('/financial', 'MasjidController@indexFinance')->name('financial.list');
Route::post('/financial', 'MasjidController@storeFinance')->name('financial.update');
Route::get('/jumat', 'MasjidController@indexJumat')->name('jumat.list');
Route::post('/jumat', 'MasjidController@storeJumat')->name('jumat.update');
Route::get('/news', 'MasjidController@indexNews')->name('news.list');
Route::post('/news/update', 'MasjidController@storeNews')->name('news.update');
Route::post('/news/add', 'MasjidController@storeNews')->name('news.store');
Route::post('/news/detail', 'MasjidController@showNews')->name('news.detail');
Route::post('/news/delete', 'MasjidController@destroyNews')->name('news.delete');
