<?php

use \Illuminate\Support\Facades\Route;



Route::prefix('/publish')->group(function () {
    Route::get('/', 'PublishController@index')->name('publish.index');
});






        
        // Rest
        Route::prefix('/rests')->group(function () {
            Route::get('/', 'RestController@index')->name('rests.index');
            Route::get('/trashed', 'RestController@trashed')->name('rests.trashed');
            Route::delete('/destroy/{id}', 'RestController@destroy')->name('rests.destroy');
            Route::get('/{id}/restore', 'RestController@restore')->name('rests.restore');
            Route::delete('/{id}/forceDelete', 'RestController@forceDelete')->name('rests.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', 'RestController@edit')->name('rests.edit');
            Route::match(['post', 'get'], '/create', 'RestController@create')->name('rests.create');
        });
        

        
        // Segment
        Route::prefix('/segments')->group(function () {
            Route::get('/', 'SegmentController@index')->name('segments.index');
            Route::get('/trashed', 'SegmentController@trashed')->name('segments.trashed');
            Route::delete('/destroy/{id}', 'SegmentController@destroy')->name('segments.destroy');
            Route::get('/{id}/restore', 'SegmentController@restore')->name('segments.restore');
            Route::delete('/{id}/forceDelete', 'SegmentController@forceDelete')->name('segments.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', 'SegmentController@edit')->name('segments.edit');
            Route::match(['post', 'get'], '/create', 'SegmentController@create')->name('segments.create');
        });
        

        // Food
        Route::prefix('/food')->group(function () {
            Route::get('/', 'FoodController@index')->name('food.index');
            Route::get('/trashed', 'FoodController@trashed')->name('food.trashed');
            Route::delete('/destroy/{id}', 'FoodController@destroy')->name('food.destroy');
            Route::get('/{id}/restore', 'FoodController@restore')->name('food.restore');
            Route::delete('/{id}/forceDelete', 'FoodController@forceDelete')->name('food.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', 'FoodController@edit')->name('food.edit');
            Route::match(['post', 'get'], '/create', 'FoodController@create')->name('food.create');
        });
        
        // Foods
        Route::prefix('/foods')->group(function () {
            Route::get('/', 'FoodsController@index')->name('foods.index');
            Route::get('/trashed', 'FoodsController@trashed')->name('foods.trashed');
            Route::delete('/destroy/{id}', 'FoodsController@destroy')->name('foods.destroy');
            Route::get('/{id}/restore', 'FoodsController@restore')->name('foods.restore');
            Route::delete('/{id}/forceDelete', 'FoodsController@forceDelete')->name('foods.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', 'FoodsController@edit')->name('foods.edit');
            Route::match(['post', 'get'], '/create', 'FoodsController@create')->name('foods.create');
        });
        
        // Rest
        Route::prefix('/rests')->group(function () {
            Route::get('/', 'RestController@index')->name('rests.index');
            Route::get('/trashed', 'RestController@trashed')->name('rests.trashed');
            Route::delete('/destroy/{id}', 'RestController@destroy')->name('rests.destroy');
            Route::get('/{id}/restore', 'RestController@restore')->name('rests.restore');
            Route::delete('/{id}/forceDelete', 'RestController@forceDelete')->name('rests.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', 'RestController@edit')->name('rests.edit');
            Route::match(['post', 'get'], '/create', 'RestController@create')->name('rests.create');
        });
        
        // User
        Route::prefix('/users')->group(function () {
            Route::get('/', 'UserController@index')->name('users.index');
            Route::get('/trashed', 'UserController@trashed')->name('users.trashed');
            Route::delete('/destroy/{id}', 'UserController@destroy')->name('users.destroy');
            Route::get('/{id}/restore', 'UserController@restore')->name('users.restore');
            Route::delete('/{id}/forceDelete', 'UserController@forceDelete')->name('users.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', 'UserController@edit')->name('users.edit');
            Route::match(['post', 'get'], '/create', 'UserController@create')->name('users.create');
        });
        
        // Rest
        Route::prefix('/rests')->group(function () {
            Route::get('/', 'RestController@index')->name('rests.index');
            Route::get('/trashed', 'RestController@trashed')->name('rests.trashed');
            Route::delete('/destroy/{id}', 'RestController@destroy')->name('rests.destroy');
            Route::get('/{id}/restore', 'RestController@restore')->name('rests.restore');
            Route::delete('/{id}/forceDelete', 'RestController@forceDelete')->name('rests.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', 'RestController@edit')->name('rests.edit');
            Route::match(['post', 'get'], '/create', 'RestController@create')->name('rests.create');
        });
        
        // User
        Route::prefix('/users')->group(function () {
            Route::get('/', 'UserController@index')->name('users.index');
            Route::get('/trashed', 'UserController@trashed')->name('users.trashed');
            Route::delete('/destroy/{id}', 'UserController@destroy')->name('users.destroy');
            Route::get('/{id}/restore', 'UserController@restore')->name('users.restore');
            Route::delete('/{id}/forceDelete', 'UserController@forceDelete')->name('users.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', 'UserController@edit')->name('users.edit');
            Route::match(['post', 'get'], '/create', 'UserController@create')->name('users.create');
        });
        