<?php

use Illuminate\Support\Facades\Route;

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

// Routes for home, login, logout, forgot-password.
Route::get('logout-home','ThemeController@logout');
Route::get('blank','ThemeController@blank')->name('blank');
Route::get('Forgot-password','ThemeController@forgotPassword')->name('Forgot-password');
Route::post('account','ThemeController@store');
Route::post('home','ThemeController@home')->name('home');
Auth::routes();

// Routes for tables.
Route::get('tables/index','TableController@index')->name('tables.index');
Route::get('tables/create','TableController@create')->name('tables.create');
Route::post('tables/store','TableController@store')->name('tables.store');
Route::get('/home', 'ThemeController@index')->name('home')->middleware('auth');

// Routes for chart.
Route::get('charts/index','chartController@index')->name('charts.index');
Route::get('tables/{id}/edit','TableController@edit')->name('tables.edit');
Route::post('tables/update','TableController@update')->name('tables.update');
Route::delete('tables/{id}','TableController@destroy')->name('tables.destroy');

// Routes for setting profile.
Route::get('profile','profileController@index')->name('profile')->middleware('auth');
Route::post('profile/{id}','profileController@update')->name('profile.update');
Route::get('activity-log','ThemeController@log')->name('activity-log');
Route::get('settings','ThemeController@setting')->name('settings')->middleware('auth');
Route::delete('account/{id}','ThemeController@destroy')->name('account.destroy');

// Routes for emails.
Route::get('email/sendmail','EmailController@sendmail')->name('email.sendmail')->middleware('auth');
Route::post('email/{id}','JobController@enqueue')->name('emails.store');

// Routes for follow and unfollow (implementation is left)
Route::group(['middleware' => 'auth'], function() {
    Route::get('users','UserController@index')->name('users');
    Route::get('notifications','UserController@notifications');
    Route::post('users/{user}/follow','UserController@follow')->name('follow');
    Route::delete('users/{user}/unfollow','UserController@unfollow')->name('unfollow');
});

// Routes for trash data.
Route::get('tables/trash','TableController@trash')->name('tables.trash');
Route::get('tables/{id}/restore','TableController@restoreData')->name('tables.restore');
Route::get('tables/{id}/deletePer','TableController@deletePermenantly')->name('tables.permenant');

//Route for maps.
Route::get('maps','MapsController@index')->name('maps.index');

// Routes for Image Upload.
Route::get('images/uploadImage','ImageController@index')->name('images.uplaodImage');
Route::post('images/upload/store', 'ImageController@uploadFile')->name('images.store');

// Routes for Dependent dropdown
Route::get('dropdown/getStates','DropdownController@getStates')->name('dropdown.getStates');
Route::get('dropdown/create','DropdownController@create')->name('dropdown.create');
Route::get('dropdown/getCities','DropdownController@getCities')->name('dropdown.getCities');
Route::get('dropdown/showList/{id}','DropdownController@show')->name('dropdown.show');
Route::get('dropdown/edit/{id}','DropdownController@edit')->name('dropdown.edit');
Route::post('dropdown/update/{id}','DropdownController@update')->name('dropdown.update');
Route::post('dropdown/store/{id}','DropdownController@store')->name('dropdown.store');

Route::get('test','HomeController@test')->name('test');
Route::POST('Test','HomeController@test')->name('Test');