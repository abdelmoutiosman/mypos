<?php

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function() {
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function (){

        Route::get('/','WelcomeController@index')->name('welcome');

        Route::resource('categories','CategoryController')->except('show');
        Route::resource('products','ProductController')->except('show');
        Route::resource('clients','ClientController')->except('show');
        Route::resource('clients.orders','Client\OrderController')->except('show');
        Route::resource('orders','OrderController')->except('show');
        Route::get('/orders/{order}/products','OrderController@products')->name('orders.products');
        //change-password
        Route::get('users/change-password','UserController@changePassword')->name('users.change-password');
        Route::post('users/change-password','UserController@changePasswordSave')->name('users.change-password');
        //edit-profile
        Route::get('users/edit-profile/{id}','UserController@edit_profile');
        Route::post('users/update-profile/{id}','UserController@update_profile');
        Route::resource('users','UserController')->except('show');

        Route::resource('settings', 'SettingController');

    });
});
