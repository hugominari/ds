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

// Route::get('/home', 'HomeController@index')->name('home');


//Home
// Route::get('/', function(){return view('front.index');});
Route::get('/', 'Front\IndexController@index')->name('index');
Route::get('/regimento-interno', 'Front\IndexController@internalRules')->name('internal.rules');
Route::get('/historia', 'Front\IndexController@history')->name('history');
Route::get('/convenios', 'Front\AgreementsController@index')->name('agreements');

Route::get('/contato', 'Front\ContactController@index')->name('contacts');


Route::get('/membros/diretoria', 'Front\MembersController@index')->name('members.directors');
Route::get('/membros/conselho-fiscal', 'Front\MembersController@fiscals')->name('members.fiscals');

Route::get('/publicacoes', 'Front\PostsController@index')->name('posts');
Route::get('/publicacao/{id}', 'Front\PostsController@show')->name('posts.show');

Route::get('/eventos', 'Front\EventsController@index')->name('events');
Route::get('/eventos/{id}', 'Front\EventsController@show')->name('events.show');

Route::get('/cultura-e-lazer', 'Front\CultureController@index')->name('cultures');

Route::get('/', 'Front\IndexController@index')->name('index');
