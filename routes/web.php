<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\HomeController;


Auth::routes();

Route::get('/home', function () {
    return redirect("/admin");
});


Route::get('/admin', 'Admin\AdminController@index')->name('domains.index');

Route::group([
    'prefix' => env('APP_PREFIX', 'admin'),
    'namespace' => 'Admin',
    'middleware' => 'auth',
    'as' => 'admin.'
], function () {
    
    
            Route::get('/', 'HomeController@index')->name('home');
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
            
            // // Foods
            // Route::prefix('/foods')->group(function () {
            //     Route::get('/', 'FoodsController@index')->name('foods.index');
            //     Route::get('/trashed', 'FoodsController@trashed')->name('foods.trashed');
            //     Route::delete('/destroy/{id}', 'FoodsController@destroy')->name('foods.destroy');
            //     Route::get('/{id}/restore', 'FoodsController@restore')->name('foods.restore');
            //     Route::delete('/{id}/forceDelete', 'FoodsController@forceDelete')->name('foods.forceDelete');
            //     Route::match(['post', 'get'], '/{id}/edit', 'FoodsController@edit')->name('foods.edit');
            //     Route::match(['post', 'get'], '/create', 'FoodsController@create')->name('foods.create');
            // });


});



Route::namespace('site')->group(function(){
    // Route::get('/', 'HomeController')->name('home.index');
    Route::get('/{url}/imprimir', 'HomeController@print')->name('home.print');
    Route::get('/{url}', 'HomeController@index')->name('home.menu');


});

/*Rota da API */
Route::namespace('api')->group(function(){
    Route::get('/api', 'ApiController@index');

    Route::get('/api/asd', 'ArticleController@index');

    Route::get('/api/asdd', 'CategoryController@index');
    Route::get('/api/{slug}', 'CategoryController@show');

});


