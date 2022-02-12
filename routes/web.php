<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('phones', 'Front\PhonesController', ['except' => ['show', 'update']]);
    Route::post('autoGenerate', 'Front\PhonesController@autoGenerate')->name('autoGenerate');
    Route::post('/updatenumberajax/{id}', 'Front\PhonesController@updatenumberajax')->name('updatenumberajax');
    Route::post('/updateproviderajax', 'Front\PhonesController@updateproviderajax')->name('updateproviderajax');
});


