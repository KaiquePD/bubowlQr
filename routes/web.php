<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\HomeController;


Auth::routes();



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

