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

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::patch('profiles/{id}', 'ProfilesController@update')->name('profiles.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('portofolios', 'PortofoliosController@store')->name('portofolios.store');
    Route::post('portofolios/{id}', 'PortofoliosController@update')->name('portofolios.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('members', 'MemberController@index')->name('members.index');
    Route::patch('members/{user}/approve', 'MemberController@approve')->name('members.approve');
    Route::patch('members/{user}/reject', 'MemberController@reject')->name('members.reject');
});

Route::get('/search', 'PublicController@search')->name('search.result');
Route::get('/freelancer/{uuid}', 'PublicController@viewProfile')->name('profiles.view_profile');
Route::get('portofolios/{memberId}', 'PortofoliosController@show')->name('portofolios.show');
