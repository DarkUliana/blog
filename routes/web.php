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

Route::get('/', 'PostController@index');
Route::get('/{id}', 'PostController@show')->where('id', '[0-9]');

Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    Route::get('admin', function () {
        return redirect('admin/post');
    });
    Route::resource('admin/post', 'Admin\PostController');

    Route::resource('comment', 'CommentController', ['except' => 'index', 'show']);
    Route::post('comment-rating/{id}', 'CommentController@rate');
    Route::resource('admin/user', 'Admin\UserController', ['only' => ['index', 'update']]);

});

