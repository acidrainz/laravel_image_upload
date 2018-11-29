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


Route::get('/', 'UploadController@index')->name('home');
Route::post('/upload', 'UploadController@doUpload')->name('upload');
Route::post('/search', 'UploadController@doSearch')->name('search');
