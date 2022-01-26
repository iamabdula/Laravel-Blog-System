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
    return view('auth.login');
});
Auth::routes();

Route::get ('/home','HomeController@index')->name('home');

//route for the post page          @post : is a post function inside the post controller responsible for handling the view of Post Page
Route::get ('/post','PostController@post');

//route for the profile  page          @profile : is a profile function inside the post controller responsible for handling the view of Post Page
Route::get ('/profile','ProfileController@profile');

//route for the add-profile  page where method== POST          @profile : is a profile function inside the post controller responsible for handling the view of Post Page
Route::post ('/addProfile','ProfileController@addProfile');

//route for the add-profile  page where method== POST          @profile : is a profile function inside the post controller responsible for handling the view of Post Page
Route::post ('/addPost','PostController@addPost');

Route::get ('/view/{id}','PostController@view');

Route::get ('edit/{id}','PostController@edit');

Route::post('/editPost/{id}', 'PostController@editPost');

Route::get ('delete/{id}','PostController@deletPost');

Route::post('/comment/{id}','PostController@comment');

Route::get ('/admin','HomeController@Admin');

Route::get ('editUser/{id}','HomeController@editUser');

Route::post('/UpdateUser/{id}', 'HomeController@updateUser');

Route::get ('deleteUser/{id}','HomeController@deleteUser');

Route::get ('approvePost/{id}','PostController@approvePost');

Route::get('/publishPost/{id}','PostController@publishPost');