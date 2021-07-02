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

Route::post('account','ThemeController@store');
Route::get('logout-home','ThemeController@logout');
Route::get('Forgot-password','ThemeController@forgotPassword')->name('Forgot-password');
Route::post('home','ThemeController@home')->name('home');
Auth::routes();

Route::get('tables/index','tableController@index')->name('tables.index');
Route::get('tables/create','tableController@create')->name('tables.create');
Route::post('tables/store','tableController@store')->name('tables.store');
Route::get('/home', 'ThemeController@index')->name('home')->middleware('auth');

Route::get('charts/index','chartController@index')->name('charts.index');
Route::get('tables/{id}/edit','tableController@edit')->name('tables.edit');
Route::post('tables/update','tableController@update')->name('tables.update');
Route::delete('tables/{id}','tableController@destroy')->name('tables.destroy');

Route::get('profile','profileController@index')->name('profile');
Route::post('profile/{id}','profileController@update')->name('profile.update');
Route::get('activity-log','ThemeController@log')->name('activity-log');
Route::get('settings','ThemeController@setting')->name('settings');
Route::delete('account/{id}','ThemeController@destroy')->name('account.destroy');

Route::get('email/sendmail','EmailController@sendmail')->name('email.sendmail');
Route::post('email/{id}','JobController@enqueue')->name('emails.store');

Route::group(['middleware' => 'auth'], function() {
    Route::get('users','UserController@index')->name('users');
    Route::get('notifications','UserController@notifications');
    Route::post('users/{user}/follow','UserController@follow')->name('follow');
    Route::delete('users/{user}/unfollow','UserController@unfollow')->name('unfollow');
});

Route::get('tables/trash','tableController@trash')->name('tables.trash');
Route::get('tables/{id}/restore','tableController@restoreData')->name('tables.restore');
Route::get('tables/{id}/deletePer','tableController@deletePermenantly')->name('tables.permenant');

Route::get('maps','MapsController@index')->name('maps.index');

Route::get('images/uploadImage','ImageController@index')->name('images.uplaodImage');
Route::post('upload', 'ImageController@uploadFile')->name('drag-drop');