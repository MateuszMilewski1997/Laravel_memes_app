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
Route::get('/meme/add/form', 'MemesController@create_form')->name('create_meme_form')->middleware('logged');
Route::post('/meme/add/new', 'MemesController@create')->name('create_meme')->middleware('logged');
Route::get('/memes/my', 'MemesController@my_memes')->name('my_memes')->middleware('logged');
Route::get('/meme/delete/{id}', 'MemesController@delete_meme')->name('delete_meme')->middleware('logged');
Route::get('/meme/like/{id}', 'MemesController@like')->name('like_meme');
Route::get('/meme/dislike/{id}', 'MemesController@dislike')->name('dislike_meme');
Route::get('/meme/del/waiting/{id}', 'MemesController@del_waiting_room')->name('del_waiting')->middleware('admin');
Route::get('/meme/del/photo', 'MemesController@delete_file')->name('del_file')->middleware('logged');
Route::get('/meme/edit/{id}', 'MemesController@edit_meme')->name('edit_meme')->middleware('logged');
Route::post('/meme/edit/title/{id}', 'MemesController@edit_title')->name('edit_meme_title')->middleware('logged');
Route::post('/meme/edit/photo/{id}', 'MemesController@edit_photo')->name('edit_meme_photo')->middleware('logged');


Route::get('/meme/comments/{id}', 'CommentsController@all_comments')->name('all_comments');
Route::get('/meme/comments/delete/{id}', 'CommentsController@delete_comment')->name('delete_comments')->middleware('logged');
Route::post('/meme/comment/add/{id}', 'CommentsController@add_comment')->name('add_comment')->middleware('logged');

Route::get('/users/all', 'AdminController@all_users')->name('all_users')->middleware('admin');
Route::get('/users/delete/{id}', 'AdminController@delete_user')->name('delete_users')->middleware('admin');
Route::get('/users/role/{id}/{role}', 'AdminController@change_role')->name('change_role')->middleware('admin');

Route::get('/account', 'UserController@my_account')->name('my_account')->middleware('logged');
Route::post('/account/password', 'UserController@change_password')->name('change_password')->middleware('logged');
Route::post('/account/email', 'UserController@change_email')->name('change_email')->middleware('logged');

Route::get('/sendemail/send', 'SendEmailController@send');