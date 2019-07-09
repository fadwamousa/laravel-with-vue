<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List articles
Route::get('articles', 'ArticleController@index');
// List single article
Route::get('article/{id}', 'ArticleController@show');
// Create new article
Route::post('article', 'ArticleController@store');
// Update article
Route::put('article/{id}', 'ArticleController@update');
// Delete article
Route::delete('article/{id}', 'ArticleController@destroy');
