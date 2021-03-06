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

Route::post('home','ThemeController@home')->name('home');

// By default routes for forgot-password.
Route::get('Forgot-password','Auth\ForgotPasswordController@showLinkRequestForm')->name('Forgot-password');
Route::post('password/change', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.forgotPassword');
Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('user.verifyToken');
Route::post('password/reset', 'ResetPasswordController@reset')->name('updatePassword');

Auth::routes();

// Routes for emails.
Route::get('email/sendmail','EmailController@sendmail')->name('email.sendmail');
Route::post('email/{id}','EmailController@enqueue')->name('emails.store');
Route::get('logout-home','ThemeController@logout')->name('logout_user');

// Routes for tables.
Route::middleware('auth')->group(function() {
    // Routes for home, login, logout, forgot-password.
    Route::get('/home', 'ThemeController@index')->name('home');
    Route::post('account','ThemeController@store');

    // Routes for tables and chart.
    Route::get('tables/index','TableController@index')->name('tables.index')->middleware('auth');
    Route::get('tables/create','TableController@create')->name('tables.create');
    Route::post('tables/store','TableController@store')->name('tables.store');
    Route::get('tables/{id}/edit','TableController@edit')->name('tables.edit');
    Route::post('tables/update','TableController@update')->name('tables.update');
    Route::delete('tables/{id}','TableController@destroy')->name('tables.destroy');
    Route::get('charts/index','chartController@index')->name('charts.index');

    // Routes for setting profile.
    Route::get('profile','profileController@index')->name('profile');
    Route::post('profile/{id}','profileController@update')->name('profile.update');
    Route::get('activity-log','ThemeController@log')->name('activity-log');
    Route::get('settings','ThemeController@setting')->name('settings');
    Route::delete('account/{id}','ThemeController@destroy')->name('account.destroy');

    // Routes for trash data.
    Route::get('tables/trash','TableController@trash')->name('tables.trash');
    Route::get('tables/{id}/restore','TableController@restoreData')->name('tables.restore');
    Route::get('tables/{id}/deletePer','TableController@deletePermenantly')->name('tables.permenant');

    //Route for maps.
    Route::get('maps','MapsController@index')->name('maps.index');

    // Routes for Image Upload.
    Route::get('images/index', 'ImageController@index')->name('images.index');
    Route::get('images/uploadImage','ImageController@uploadImage')->name('images.uploadImage');
    Route::get('images/{id}/edit', 'ImageController@edit')->name('images.edit');
    Route::post('images/update', 'ImageController@update')->name('images.update');
    Route::post('images/upload/store', 'ImageController@uploadFile')->name('images.store');
    Route::delete('images/{id}','ImageController@destroy')->name('image.destroy');

    // Routes for Dependent dropdown
    Route::get('dropdown/getStates','DropdownController@getStates')->name('dropdown.getStates');
    Route::get('dropdown/create','DropdownController@create')->name('dropdown.create');
    Route::get('dropdown/getCities','DropdownController@getCities')->name('dropdown.getCities');
    Route::get('dropdown/showList/{id}','DropdownController@show')->name('dropdown.show');
    Route::get('dropdown/edit/{id}','DropdownController@edit')->name('dropdown.edit');
    Route::post('dropdown/update/{id}','DropdownController@update')->name('dropdown.update');
    Route::post('dropdown/store/{id}','DropdownController@store')->name('dropdown.store');

    // Routes for blank pages
    Route::get('test_Page_1','HomeController@blankPage_1')->name('test_Page_1');
    Route::get('test_Page_2','HomeController@blankPage_2')->name('test_Page_2');
    Route::get('test','HomeController@test')->name('test');
    Route::POST('Test','HomeController@test')->name('Test');
    Route::POST('blank_page_1','HomeController@demo_1')->name('blank_page_1');
    Route::POST('blank_page_2','HomeController@demo_2')->name('blank_page_2');
    Route::POST('test_page_1/addData','HomeController@addData')->name('blank_page_1.addData');

    // Routes for Notification
    Route::get('notify/index','NotificationController@index')->name('user.notify');
    
});

// Routes for forgot password (Custom)
// Route::get('Forgot-password','ThemeController@forgotPassword')->name('Forgot-password');
// Route::get('password/change','UserController@forgotPass')->name('user.forgotPassword');
// Route::get('password/{token}/reset-password','UserController@verifyPassword')->name('user.verifyToken');
// Route::post('updatePassword','UserController@updatePassword')->name('updatePassword');