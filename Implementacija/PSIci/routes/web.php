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

Route::get('/',function(){
    redirect()->route('home');
});

//PODELJENO JE PO IMENIMA KOJE SU CIJE RUTE
// KAKO SE NE BISMO POGUBILI, PISITE SAMO ISPOD SVOJE:



//TIJANA

Route::get('/series/{content_id}', 'GuestController@showSeries')->name('showseries');


Route::get('/episode/{id}','GuestController@showEpisode')->name('showepisode');











//Route::get('episode/{content_id}','');


///Route::get('episode/{content_id}','');






//Route::get('episode/{content_id}','');

///Route::get('episode/{content_id}','');




//Route::get('episode/{content_id}','');

//Route::get('episode/{id}','GuestController@showEpisode');

//Route::get('episode/{content_id}','');


//Route::get('episode/{content_id}','');




Route::get('/season/{id}', 'GuestController@showSeason')->name('season');

Route::post('/removeAccount/{id}', 'UserController@remove')->name('accremove');

Route::get('/accountManager', 'AdminController@showUsers')->name('accountManager');

Route::post('/userToAdmin/{id}', 'AdminController@makeAdmin')->name('confirm_admin');


Route::get('/addSeries','AdminController@seriesInput')->name('addseries');


Route::post('/confirmSeries', 'AdminController@makeSeries')->name('confirmSeries');

Route::post('/addActor/{id}', 'AdminController@addActorWrapper')->name('addActor');

Route::post('/addDirector/{id}','AdminController@addDirectorWrapper')->name('addDirector');

Route::get('/addSeason/{id}', 'AdminController@seasonInput')->name('addSeason');

Route::post('/confirmSeason/{id}','AdminController@makeSeason')->name('confirm_season');

Route::get('/addEpisode/{id}', 'AdminController@episodeInput')->name('addepisode');

Route::post('/confirmEpisode/{id}','AdminController@makeEpisode')->name('confirm_episode');

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

Route::group(['middleware' => 'UserMiddleware'], function()
{
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::post('/password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@resetPassword')->name('password_reset_confirm');
    Route::get('/password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password_reset');
    Route::get('/updateUnwatched/{id}', '\App\Http\Controllers\EpisodeController@updateUnwatched')->name('updateunwatched');
    Route::get('/updateWatchedSeason/{id}', '\App\Http\Controllers\EpisodeController@updateWatchedSeason')->name('update_watched_season');
    Route::get('/updateUnwatchedSeason/{id}', '\App\Http\Controllers\EpisodeController@updateUnwatchedSeason')->name('update_unwatched_season');
});

ROute::group(['middleware' => 'GuestMiddleware'], function()
{
    Route::get('/password/request', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password_request');
    Route::post('/password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@sendEmailConfirm')->name('password_email');
    Route::get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::get('/register', '\App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
});






// END MILICA



// ALEKSA



Route::post('/series/{content}/rate','UserController@rateContent')->name('rateseries');
Route::post('/season/{content}/rate','UserController@rateContent')->name('rateseason');
Route::post('/episode/{content}/rate','UserController@rateContent')->name('rateepisode');

Route::get('/search','GuestController@search')->name('search');

Route::get('/episode/{episode}/edit','AdminController@editEpisode')->name('editepisode');
Route::post('/episode/{episode}/edit/changeData','AdminController@changeEpisodeData')->name('change_episode');

Route::get('/season/{season}/edit','AdminController@editSeason')->name('editseason');
Route::post('/season/{season}/edit/changeData','AdminController@changeSeasonData')->name('change_season');

Route::get('/series/{tvshow}/edit','AdminController@editTVShow')->name('editseries');
Route::post('/series/{tvshow}/edit/changeData','AdminController@changeTvshowData')->name('change_tvshow');
Route::post('/series/{tvshow}/edit/changeGenres','AdminController@changeGenres')->name('tvshow_genre');
Route::post('/series/{tvshow}/edit/addActor','AdminController@addEditActor')->name('tvshow_actor_add');
Route::post('/series/{tvshow}/edit/addDirector','AdminController@addEditDirector')->name('tvshow_director_add');
Route::post('/series/{tvshow}/edit/deleteActors','AdminController@deleteActors')->name('tvshow_actor_delete');
Route::post('/series/{tvshow}/edit/deleteDirectors','AdminController@deleteDirectors')->name('tvshow_director_delete');

Route::post('/episode/{content}/edit/changeAvatar','AdminController@changeAvatar')->name('avatar_episode');
Route::post('/episode/{content}/edit/deletePictures','AdminController@deletePictures')->name('delete_pic_episode');
Route::post('/episode/{content}/edit/addPictures','AdminController@addPictures')->name('add_pic_episode');
Route::post('/season/{content}/edit/changeAvatar','AdminController@changeAvatar')->name('avatar_season');
Route::post('/season/{content}/edit/deletePictures','AdminController@deletePictures')->name('delete_pic_season');
Route::post('/season/{content}/edit/addPictures','AdminController@addPictures')->name('add_pic_season');
Route::post('/series/{content}/edit/changeAvatar','AdminController@changeAvatar')->name('avatar_tvshow');
Route::post('/series/{content}/edit/deletePictures','AdminController@deletePictures')->name('delete_pic_tvshow');
Route::post('/series/{content}/edit/addPictures','AdminController@addPictures')->name('add_pic_tvshow');




//END ALEKSA

// FILIP
Route::get('mostPopular','HomeController@mostPopular')->name('mostpopular');
Route::get('upcoming','HomeController@upcoming')->name('upcoming');

Route::group(['middleware' => 'UserMiddleware'], function () {

    // any route here will only be accessible for logged in users

Route::post('/addComment','EpisodeController@comment')->name('addcomment');
Route::get('/deleteComment/{id}','EpisodeController@deleteComment')->name('deletecomment');
Route::get('/updateInfo','UserController@updateInfo')->name('infoupdate');
Route::post('/postUpdateInfo','UserController@postUpdateInfo')->name('postinfoupdate');

Route::get('/updateWatched/{id}','EpisodeController@updateWatched')->name('updatewatched');
Route::get('/watchedEpisodes','EpisodeController@watched')->name('watchedepisodes');
});


Route::group(['middleware' => 'AdminMiddleware'], function()
{
    Route::get('/updateSpoiler/{id}', 'EpisodeController@updateSpoiler')->name('updatespoiler');
    Route::get('/updateSpoilerRemove/{id}', 'EpisodeController@updateSpoilerRemove')->name('updatespoilerremove');
    Route::post('/removeEpisode/{id}','EpisodeController@removeEpisode')->name('episoderemove');
    Route::post('/removeSeason/{id}','AdminController@removeSeason')->name('seasonremove');
    Route::post('/removeSeries/{id}','AdminController@removeSeries')->name('seriesremove');
    Route::get('/addTrailerContent/{id}','AdminController@addTrailer')->name('addtrailer');
    Route::post('/addTrailerContentPost','AdminController@addTrailerPost')->name('addtrailerpost');
    Route::get('/addPictures/{id}','AdminController@addPicturesContent')->name('addpictures');
    Route::post('addPicturesPost','AdminController@addPicturesContentPost')->name('addpicturespost');
    Route::get('/redirectBackContent/{id}','AdminController@redirectBackContent')->name('redirectback');

});


Route::group(['middleware' => 'OnlyUserMiddleware'], function ()
{

});
// END FILIP


