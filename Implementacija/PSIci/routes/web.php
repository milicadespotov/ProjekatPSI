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

Route::get('/series/{id}', 'GuestController@showSeries')->name('showseries');


Route::get('episode/{id}','GuestController@showEpisode');


//TIJANA DODAJ NAZIV KONTROLERA KOJI PRIKAZUJE EPIZODU!!!!!

<<<<<<< HEAD
//Route::get('episode/{content_id}','');

Route::get('episode/{id}','GuestController@showEpisode');
=======
//Route::get('episode/{content_id}','');


//Route::get('episode/{content_id}','');

Route::get('episode/{id}','GuestController@showEpisode');

>>>>>>> e5f924f466b55314e00b08ba527185a98cf5e276


Route::get('/season/{id}', 'GuestController@showSeason');

Route::post('/removeAccount/{id}', 'UserController@remove');

Route::get('/accountManager', 'AdminController@showUsers');

Route::post('/userToAdmin/{id}', 'AdminController@makeAdmin');
// END TIJANA


// MILICA

Auth::routes();
//Route::post('/login','UserController@loginCheck')->name('login');



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
Route::get('/deleteComment/{id}','EpisodeController@deleteComment')->name('deletecomment');
Route::get('/updateSpoiler/{id}','EpisodeController@updateSpoiler')->name('updatespoiler');
Route::get('/updateWatched/{id}','EpisodeController@updateWatched')->name('updatewatched');
<<<<<<< HEAD
Route::get('/updateInfo','UserController@updateInfo')->name('infoupdate');
=======

>>>>>>> e5f924f466b55314e00b08ba527185a98cf5e276
// END FILIP


