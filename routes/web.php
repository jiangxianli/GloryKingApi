<?php

//管理后台
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin.auth'], function () {

    //英雄操作
    Route::group(['prefix' => 'hero'], function () {
        Route::get('/', 'HeroController@getHeroList'); //英雄列表
        Route::get('add', 'HeroController@getAddHero'); //添加英雄页面
        Route::post('add', 'HeroController@postAddHero'); //添加英雄操作
        Route::get('{id}/edit', 'HeroController@getEditHero'); //编辑英雄页面
        Route::post('{id}/edit', 'HeroController@postEditHero'); //编辑英雄操作
    });

    //素材操作
    Route::group(['prefix' => 'element'], function () {
        Route::get('/', 'ElementController@getIndex'); //素材列表页面
        Route::get('add', 'ElementController@getAddElement'); //添加素材页面
        Route::post('add', 'ElementController@postAddElement'); //添加素材操作
        Route::get('{id}/edit', 'ElementController@getEditElement'); //编辑素材页面
        Route::post('{id}/edit', 'ElementController@postEditElement'); //编辑素材操作
        Route::post('set-duration', 'ElementController@setElementDuration'); //设置视频时长
        Route::post('search', 'ElementController@searchElement'); //搜索素材
    });

    //英雄类型操作
    Route::group(['prefix' => 'hero-type'], function () {
        Route::get('add', 'HeroTypeController@getAdd'); //添加英雄类型页面
        Route::post('add', 'HeroTypeController@postAdd'); //添加英雄类型操作
    });

    //专题操作
    Route::group(['prefix' => 'theme'], function () {
        Route::get('/', 'ThemeController@getIndex'); //专题列表页面
        Route::get('add', 'ThemeController@getAddTheme'); //添加专题页面
        Route::post('add', 'ThemeController@postAddTheme'); //添加专题操作
        Route::get('{id}/edit', 'ThemeController@getEditTheme'); //编辑专题页面
        Route::post('{id}/edit', 'ThemeController@postEditTheme'); //编辑专题操作
    });

    //通用工具
    Route::group(['prefix' => 'common'], function () {
        Route::post('upload-image', 'CommonController@postUploadImage'); //上传图片
        Route::post('parse-video-url', 'CommonController@postParseVideoUrl'); //解析视频地址
    });
});

Route::get('admin/login', 'Admin\AdminController@getLogin');
Route::post('admin/login', 'Admin\AdminController@postLogin');
Route::get('admin/logout', 'Admin\AdminController@getLogout');
