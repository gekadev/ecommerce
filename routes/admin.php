<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// routes for non autunticated routes
Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin','prefix'=>'admin'],function (){
    Route::get('login','LoginController@login')->name('admin.login');
    Route::post('authinticate','LoginController@authinticate')->name('admin.authinticate');

});

//routes for all authinticated users
Route::group(['namespace' =>'Dashboard','middleware'=>'auth:admin','prefix'=>'admin'],function (){

    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::get('/logout','LoginController@logout')->name('admin.logout');
    //routes for settings
    Route::group(['prefix'=>'Settings'],function (){
        Route::get('shippingMethods/{type}','SettingController@editShippingMethods')->name('settings.editShippingMethods');
        Route::put('shippingMethods/{id}','SettingController@updateShippingMethods')->name('settings.updateShippingMethods');
    });
    //routes for admin profile
    Route::group(['prefix'=>'profile'],function (){
        Route::get('edit/{id}','ProfileController@editProfile')->name('profile.edit');
        Route::put('update/{id}','ProfileController@updateprofile')->name('profile.update');
        Route::put('update_password/{id}',"ProfileController@update_password")->name("profile.update_password");
        Route::post('update_image/{id}',"ProfileController@update_images")->name("profile.update_image");
    });
});
