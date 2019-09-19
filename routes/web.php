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
Route::get('/add', 'MemesController@create')->name('create');
Route::get('/memes/my', 'MemesController@my_memes')->name('my_memes');
Route::get('/meme/delete/{id}', 'MemesController@delete_meme')->name('delete_meme');
