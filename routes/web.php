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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MemesController@memes')->name('all_memes');
Route::get('/waiting_room', 'MemesController@waiting_room')->name('waiting_room');
Route::get('/meme/add/form', 'MemesController@create_form')->name('create_meme_form');
Route::post('/meme/add/new', 'MemesController@create')->name('create_meme');
Route::get('/memes/my', 'MemesController@my_memes')->name('my_memes');
Route::get('/meme/delete/{id}', 'MemesController@delete_meme')->name('delete_meme');
Route::get('/meme/like/{id}', 'MemesController@like')->name('like_meme');
Route::get('/meme/dislike/{id}', 'MemesController@dislike')->name('dislike_meme');
Route::get('/meme/del/waiting/{id}', 'MemesController@del_waiting_room')->name('del_waiting');
Route::get('/meme/del/photo', 'MemesController@delete_file')->name('del_file');

Route::get('/meme/comments/{id}', 'CommentsController@all_comments')->name('all_comments');
Route::get('/meme/comments/delete/{id}', 'CommentsController@delete_comment')->name('delete_comments');
Route::post('/meme/comment/add/{id}', 'CommentsController@add_comment')->name('add_comment');

Route::get('/sendemail/send', 'SendEmailController@send');