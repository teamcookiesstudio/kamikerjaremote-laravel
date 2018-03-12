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

Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('profile', 'ProfileController@show')->name('profiles.show');
    Route::get('profile/edit', 'ProfileController@edit')->name('profiles.edit');
    Route::patch('profile', 'ProfileController@update')->name('profiles.update');    
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('members', 'MemberController@show')->name('members.index');
    Route::get('members/{user_id}/approve', 'MemberController@approved')->name('members.approve');
    Route::get('members/{user_id}/reject', 'MemberController@reject')->name('members.reject');
});

Route::get('/search', 'HomeController@search')->name('search');
Route::get('/freelancer/{hash}', 'HomeController@viewProfile')->name('view_profile');
