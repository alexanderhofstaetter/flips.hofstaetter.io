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

Route::group(['prefix' => '/uni', 'as' => 'uni.'], function(){
	Route::get('/general', 'PagesController@general')->name('general');
	Route::get('/classes', 'PagesController@classes')->name('classes');
	Route::get('/grades', 'PagesController@grades')->name('grades');
	Route::get('/exams', 'PagesController@exams')->name('exams');
	Route::get('/news', 'PagesController@news')->name('news');
	Route::get('/planobjects', 'PagesController@planobjects')->name('planobjects');
	Route::get('/registration', 'PagesController@registration')->name('registration');
});

Route::get('/settings', 'PagesController@settings')->name('settings');
Route::get('/download/{filename}', 'PagesController@download')->name('download');

Route::group(['prefix' => '/user/{user}', 'as' => 'user.'], function(){
    Route::post('/update', 'UserController@update')->name('update');
    Route::group(['prefix' => '/wulearn', 'as' => 'wulearn.'], function(){
		Route::group(['prefix' => '/load', 'as' => 'load.'], function(){
			Route::post('/data', 'WuLearnController@load_data')->name('data');
			Route::post('/meta', 'WuLearnController@load_meta')->name('meta');
			Route::post('/exams', 'WuLearnController@load_exams')->name('exams');
			Route::post('/news', 'WuLearnController@load_news')->name('news');
		});
		Route::get('/open/{url}', 'WuLearnController@open')->name('open');
		Route::post('/verify', 'WuLearnController@verify')->name('verify');
	});
	Route::group(['prefix' => '/wulpis', 'as' => 'wulpis.'], function(){
		Route::group(['prefix' => '/load', 'as' => 'load.'], function(){
			Route::post('/data', 'WuLpisController@load_data')->name('data');
		});
	});
});

Route::group(['prefix' => '/flips', 'as' => 'flips.'], function(){
    Route::get('/init', 'FlipsController@init')->name('init');
    Route::get('/studienabschnitte', 'FlipsController@studienabschnitte')->name('studienabschnitte');
    Route::get('/veranstaltungen', 'FlipsController@veranstaltungen')->name('veranstaltungen');
});