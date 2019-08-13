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

Route::get('/', 'HomeController@showHomepage')->name('homepage');
Route::get('/show-gallery/{gallery}', 'HomeController@showGallery')->name('show-gallery');

Route::get('/get-images/{folder}', 'HomeController@getFolderImages')->name('get-images');
