<?php

use Illuminate\Support\Facades\Route;

Route::prefix('brand')->namespace('Brand')->name('brand.')->group(function () {
    Route::get('/login', 'Auth\AuthController@showLoginForm')->name('login_form');
    Route::post('/login', 'Auth\AuthController@login')->name('login');
    Route::get('forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

    Route::middleware(['auth:brand'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('brand.dashboard');
        });

        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
        Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

        #brand profile routes
        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::post('/profile/update', 'UserController@updateProfile')->name('profile.update');

        #brand banner
        Route::resource('brand-category', 'CategoryController')->name('*', 'brand-category');

        #brand banner
        Route::resource('brand-about', 'BrandAboutController')->name('*', 'brand-about');

        #brand banner
        Route::resource('brand-banner', 'BrandBannerController')->name('*', 'brand-banner');
        #brand slider
        Route::resource('brand-slider', 'BrandSliderController')->name('*', 'brand-slider');

        #sub brand
        Route::get('/sub-brand', 'SubBrandController@index')->name('sub-brand.index');
        Route::get('/sub-brand/create', 'SubBrandController@create')->name('sub-brand.create');
        Route::get('/sub-brand/{subBrand?}', 'SubBrandController@show')->name('sub-brand.show');
        Route::post('/sub-brand/store', 'SubBrandController@store')->name('sub-brand.store');
        Route::get('/edit-sub-brand/{subBrand?}', 'SubBrandController@edit')->name('sub-brand.edit');
        Route::put('/update-sub-brand/{subBrand?}', 'SubBrandController@update')->name('sub-brand.update');
        Route::delete('/destroy-sub-brand/{subBrand?}', 'SubBrandController@destroy')->name('sub-brand.destroy');

    });
});
