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
    $user = auth()->user();
    return view('welcome', compact('user'));
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('profile', 'ProfileController@show')->name('profiles.show');
    Route::get('profile/edit', 'ProfileController@edit')->name('profiles.edit');
    Route::patch('profile', 'ProfileController@update')->name('profiles.update');    
});

Route::middleware(['auth'])->group(function() {
    Route::post('portofolio', 'PortofolioController@store')->name('portofolio.store');
    Route::post('portofolio/{id}', 'PortofolioController@update')->name('portofolio.update');
    Route::get('portofolio/{id}', 'PortofolioController@show')->name('portofolio.show');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('members', 'MemberController@index')->name('members.index');
    Route::patch('members/{user}/approve', 'MemberController@approve')->name('members.approve');
    Route::patch('members/{user}/reject', 'MemberController@reject')->name('members.reject');
});

Route::get('/search', 'HomeController@search')->name('search.result');
Route::get('/freelancer/{hash}', 'HomeController@viewProfile')->name('profiles.view_profile');
