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
    $route->group(['prefix' => 'members', 'as' => 'members.'], function ($route) {
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
