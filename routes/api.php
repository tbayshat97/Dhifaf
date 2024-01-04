<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('API')->group(function () {
    Route::get('sap/update-produts', 'SapController@updateProduts')->name('sap.update-products');
    Route::get('sap/update-produts-prices', 'SapController@updatePrices')->name('sap.update-products-price');
    Route::get('sap/update-produts-search', 'SapController@updateSearchAppearance')->name('sap.update-products-search');
});
