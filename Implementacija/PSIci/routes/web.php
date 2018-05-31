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
    return view('home.index');
});

Route::get('/series/{id}', 'GuestController@showSeries');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<<<<<<< HEAD
Route::post('/addComment','EpisodeController@comment');
Route::get('deleteComment/{id}','EpisodeController@deleteComment')->name('deletecomment');
Route::get('updateSpoiler/{id}','EpisodeController@updateSpoiler')->name('updatespoiler');
Route::get('updateWatched/{id}','EpisodeController@updateWatched')->name('updatewatched');



//TIJANA DODAJ NAZIV KONTROLERA KOJI PRIKAZUJE EPIZODU!!!!!
Route::get('episode/{content_id}','');
=======
Route::get('/season/{id}', 'GuestController@showSeason');

Route::post('/removeAccount/{id}', 'UserController@remove');
>>>>>>> e17a842a86b4b6ad35da60f4417fb19efe41b4af
