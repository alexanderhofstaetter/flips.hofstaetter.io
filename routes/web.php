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

Route::get('/', 'PagesGuestController@home')->name('home');

Auth::routes();

Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
Route::get('/settings', 'PagesController@settings')->name('settings');
Route::get('/download/{filename}', 'PagesController@download')->name('download');

Route::group(['prefix' => '/user/{id}', 'as' => 'user.'], function(){
    Route::post('/update', 'UserController@update')->name('update');
    Route::group(['prefix' => '/wulearn', 'as' => 'wulearn.'], function(){
		Route::group(['prefix' => '/load', 'as' => 'load.'], function(){
			Route::post('/data', 'WuLearnController@load_data')->name('data');
			Route::post('/meta', 'WuLearnController@load_meta')->name('meta');
			Route::post('/webview', 'WuLearnController@load_webview')->name('webview');
		});
		Route::post('/verify', 'WuLearnController@verify')->name('verify');
	});
});

Route::group(['prefix' => '/flips', 'as' => 'flips.'], function(){
    Route::get('/init', 'FlipsController@init')->name('init');
    Route::get('/studienabschnitte', 'FlipsController@studienabschnitte')->name('studienabschnitte');
    Route::get('/veranstaltungen', 'FlipsController@veranstaltungen')->name('veranstaltungen');
});