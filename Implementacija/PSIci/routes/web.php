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

Route::get('/series/{content_id}', 'GuestController@showSeries')->name('showseries');


Route::get('episode/{id}','GuestController@showEpisode')->name('showepisode');











//Route::get('episode/{content_id}','');


///Route::get('episode/{content_id}','');






//Route::get('episode/{content_id}','');

///Route::get('episode/{content_id}','');




//Route::get('episode/{content_id}','');

//Route::get('episode/{id}','GuestController@showEpisode');

//Route::get('episode/{content_id}','');


//Route::get('episode/{content_id}','');




Route::get('/season/{id}', 'GuestController@showSeason');

Route::post('/removeAccount/{id}', 'UserController@remove');

Route::get('/accountManager', 'AdminController@showUsers');

Route::post('/userToAdmin/{id}', 'AdminController@makeAdmin');

Route::get('/addSeries','AdminController@seriesInput');

Route::post('/confirmSeries', 'AdminController@makeSeries');

Route::post('/addActor/{id}', 'AdminController@addActor');

Route::post('/addDirector/{id}','AdminController@addDirector');

Route::post('/addSeason/{id}', 'AdminController@seasonInput');

Route::post('/confirmSeason/{id}','AdminController@makeSeason');

Route::post('/addEpisode/{id}', 'AdminController@episodeInput');

Route::post('/confirmEpisode/{id}','AdminController@makeEpisode');

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

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');

Route::get('/register', '\App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');

Route::get('/password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password_reset');

Route::post('/password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@resetPassword')->name('password_reset_confirm');

Route::get('/password/request', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password_request');


// END MILICA



// ALEKSA




Route::post('/series/{tvshow}/rate','UserController@rateContent');
Route::post('/season/{id}/rate','UserController@rateContent');
Route::post('/episode/{id}/rate','UserController@rateContent');

Route::post('/series/{content}/rate','UserController@rateContent');
Route::post('/season/{content}/rate','UserController@rateContent');
Route::post('/episode/{content}/rate','UserController@rateContent');

Route::get('/search','GuestController@search');









Route::post('/series/{tvshow}/rate','UserController@rateSeries');
Route::post('/season/{id}/rate');
Route::post('/episode/{id}/rate');




Route::post('/series/{tvshow}/rate','UserController@rateSeries');
Route::post('/season/{id}/rate');
Route::post('/episode/{id}/rate');




//END ALEKSA

// FILIP
Route::post('/addComment','EpisodeController@comment')->name('addcomment');
Route::get('/deleteComment/{id}','EpisodeController@deleteComment')->name('deletecomment');
Route::get('/updateSpoiler/{id}','EpisodeController@updateSpoiler')->name('updatespoiler');
Route::get('/updateSpoilerRemove/{id}','EpisodeController@updateSpoilerRemove')->name('updatespoilerremove');
Route::get('/updateWatched/{id}','EpisodeController@updateWatched')->name('updatewatched');
Route::get('/updateInfo','UserController@updateInfo')->name('infoupdate');
Route::post('/postUpdateInfo','UserController@postUpdateInfo')->name('postinfoupdate');
Route::get('/watchedEpisodes','EpisodeController@watched')->name('watchedepisodes');
// END FILIP


