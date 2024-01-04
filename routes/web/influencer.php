<?php

use Illuminate\Support\Facades\Route;

Route::prefix('influencer')->namespace('Influencer')->name('influencer.')->group(function () {
    Route::get('/login', 'Auth\AuthController@showLoginForm')->name('login_form');
    Route::post('/login', 'Auth\AuthController@login')->name('login');
    Route::get('forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');


    Route::middleware(['auth:influencer'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('influencer.dashboard');
        });

        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
        Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::post('/profile/update', 'UserController@updateProfile')->name('profile.update');

        Route::get('product', 'InfluencerProductController@index')->name('influencer.product.index');
        Route::delete('product/{product}', 'InfluencerProductController@destroy')->name('influencer.product.destroy');
        Route::post('add-product/{product}', 'InfluencerProductController@addToInfluencer')->name('add.product.influencer');
        Route::get('my-product', 'InfluencerProductController@myProduct')->name('product.influencer');
    });
});
