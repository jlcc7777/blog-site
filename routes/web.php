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

Auth::routes();

Route::get('/','BlogController@index');
Route::get('/home','BlogController@index');

Route::get('/view_blog/{blogID}','BlogController@viewBlog');

Route::get('/my_blog/{status}','BlogController@myBlog');

Route::post('/my_blog/changeBlodStatus','BlogController@changeBlodStatus');

Route::post('/spam_blog','BlogController@changeBlodStatus');

Route::post('/view_blog','BlogController@insertComment');

Route::post('/view_blog/spamComment','BlogController@spamComment');

Route::get('/create_blog','BlogController@createBLog');

Route::post('/create_blog','BlogController@insertNewBlog');

Route::get('/edit_blog/{blogID}','BlogController@editBlog');

Route::post('/edit_blog','BlogController@updateBlog');

Route::get('auth/google', 'Auth\RegisterController@redirectToProvider');

Route::get('auth/google/callback', 'Auth\RegisterController@handleProviderCallback');