<?php

Auth::routes();

Route::get('/', 'IndexController@index')->name('index');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/categories/data', 'CategoryController@data')->name('categories.data');
    Route::resource('categories', 'CategoryController')->only(['index', 'show']);
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/categories/{category}/delete', 'CategoryController@delete')->name('categories.delete');
        Route::resource('categories', 'CategoryController')->except(['index', 'show']);
    });


    Route::get('/posts/data', 'PostController@data')->name('posts.data');
    Route::get('/posts/{post}/delete', 'PostController@delete')->name('posts.delete');
    Route::resource('posts', 'PostController');
});




