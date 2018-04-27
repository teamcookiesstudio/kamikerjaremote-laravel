<?php

Route::get('/', function () {
    $user = auth()->user();

    return view('welcome', compact('user'));
});

Auth::routes();

/*
 * Admin
 */

Route::group(['as' => 'admin.', 'namespace' => 'Admin'], function ($route) {

    /*
     * Dashboard
     */
    $route->get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    /*
     * Members
     */
    $route->group(['prefix' => 'members', 'as' => 'members.', 'middleware' => ['auth']], function ($route) {
        $route->get('/', ['as' => 'index', 'uses' => 'MembersController@index']);
        $route->any('datatables', ['as' => 'datatables', 'uses' => 'MembersController@datatables']);
        $route->get('approve/{id}', ['as' => 'approve', 'uses' => 'MembersController@approve']);
        $route->get('reject/{id}', ['as' => 'reject', 'uses' => 'MembersController@reject']);
        $route->post('approve-selected', ['as' => 'approve-selected', 'uses' => 'MembersController@approveSelected']);
        $route->post('reject-selected', ['as' => 'reject-selected', 'uses' => 'MembersController@rejectSelected']);
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::patch('profiles/{id}', 'ProfilesController@update')->name('profiles.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('portofolios', 'PortofoliosController@store')->name('portofolios.store');
    Route::post('portofolios/{id}', 'PortofoliosController@update')->name('portofolios.update');
});

Route::get('/search', 'PublicController@search')->name('search.result');
Route::get('/freelancer/{uuid}', 'PublicController@viewProfile')->name('profiles.view_profile');
Route::get('portofolios/{memberId}', 'PortofoliosController@show')->name('portofolios.show');
