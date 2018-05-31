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
//PODELJENO JE PO IMENIMA KOJE SU CIJE RUTE
// KAKO SE NE BISMO POGUBILI, PISITE SAMO ISPOD SVOJE:



//TIJANA

Route::get('/series/{id}', 'GuestController@showSeries');

//TIJANA DODAJ NAZIV KONTROLERA KOJI PRIKAZUJE EPIZODU!!!!!
<<<<<<< HEAD
//Route::get('episode/{content_id}','');
=======
Route::get('episode/{id}','GuestController@showEpisode');
>>>>>>> f2c9d2c288acb4f9de32beceb32e1076fa2fd74c


Route::get('/season/{id}', 'GuestController@showSeason');

Route::post('/removeAccount/{id}', 'UserController@remove');

Route::get('/accountManager', 'AdminController@showUsers');
// END TIJANA


// MILICA
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/adminProfile', [
    'uses' => 'AdminController@adminProfile',
    'as' => 'adminProfile'
] );

Route::get('/userProfile', [
    'uses' => 'UserController@userProfile',
    'as' => 'userProfile'

]);




// END MILICA



// ALEKSA

Route::post('/series/{id}/rate');
Route::post('/season/{id}/rate');
Route::post('/episode/{id}/rate');




//END ALEKSA

// FILIP
Route::post('/addComment','EpisodeController@comment');
Route::get('deleteComment/{id}','EpisodeController@deleteComment')->name('deletecomment');
Route::get('updateSpoiler/{id}','EpisodeController@updateSpoiler')->name('updatespoiler');
Route::get('updateWatched/{id}','EpisodeController@updateWatched')->name('updatewatched');

// END FILIP


