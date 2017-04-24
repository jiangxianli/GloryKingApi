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


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'hero'], function () {
        Route::get('/', ['as' => 'admin.hero', 'uses' => 'HeroController@getHeroList']);
        Route::get('add', 'HeroController@getAddHero');
        Route::post('add', 'HeroController@postAddHero');
        Route::get('{id}/edit', 'HeroController@getEditHero');
        Route::post('{id}/edit', 'HeroController@postEditHero');
    });

    Route::group(['prefix' => 'hero-type'], function () {
        Route::get('add', 'HeroTypeController@getAdd');
        Route::post('add', 'HeroTypeController@postAdd');
    });

    Route::group(['prefix' => 'common'], function () {
        Route::post('upload-image', 'CommonController@postUploadImage');
    });
});
