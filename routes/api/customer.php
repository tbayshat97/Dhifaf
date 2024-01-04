<?php

use Illuminate\Support\Facades\Route;

Route::prefix('customer')->namespace('API\Customer')->middleware('apilogger')->group(function () {
    # Auth Routes
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('verify-sms', 'AuthController@verifySMS');
    Route::post('resend-sms', 'AuthController@resendSMS');
    Route::post('forget-password', 'AuthController@forgetPassword');
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::post('facebook/login', 'AuthController@facebookLogin');
    Route::post('google/login', 'AuthController@googleLogin');
    Route::post('apple/login', 'AuthController@appleLogin');

    # Public
    Route::get('static-pages', 'StaticPageController@list');
    Route::get('website-pages', 'WebsitePageController@list');
    Route::get('walkthrough', 'WalkthroughController@list');
    Route::get('main-slider', 'MainSliderController@list');
    Route::get('website-slider', 'MainSliderController@websiteSliderlist');
    Route::get('city', 'CityController@list');
    Route::get('area/{city}', 'AreaController@list');
    Route::get('brand/normal', 'BrandController@normal');
    Route::get('brand/luxury', 'BrandController@luxury');
    Route::get('Influencers', 'InfluencerController@list');
    Route::get('Influencer/{influencer}', 'InfluencerController@show');
    Route::get('Influencer/slug/{slug}', 'InfluencerController@showWhereSlug');
    Route::get('division', 'DivisionController@list');
    Route::get('division/{division}', 'DivisionController@categories');
    Route::get('division/slug/{slug}', 'DivisionController@divisionWhereSlug');
    Route::get('categories', 'CategoryController@list');
    Route::get('categories/luxury', 'CategoryController@luxury');
    Route::get('banners', 'BannerController@list');
    Route::get('follow-us', 'FollowUsController@list');
    Route::get('follow-us', 'FollowUsController@list');
    Route::get('sections', 'SectionController@list');
    Route::get('section/show', 'SectionController@show');
    Route::get('about-sections', 'AboutSectionController@list');
    Route::get('about-section/show', 'AboutSectionController@show');
    Route::get('galleries', 'GalleryController@list');
    Route::get('gallery/album/{gallery}', 'GalleryController@album');
    Route::get('contact-us', 'ContactController@index');
    Route::post('quote', 'QuoteController@store');
    Route::get('faq', 'FaqController@list');
    Route::get('governorate', 'GovernorateController@list');

    # Luxury Brand
    Route::get('luxury-brand/{brand}', 'BrandController@showLuxury');
    Route::get('luxury-brand/slug/{slug}', 'BrandController@showLuxuryWhereSlug');

    # Product
    Route::get('product', 'ProductController@list');
    Route::get('product/category/{category}', 'ProductController@showCategoryProduct');
    Route::get('product/category/slug/{slug}', 'ProductController@showCategoryProductWhereSlug');
    Route::get('product/subCategory/{subCategory}', 'ProductController@showSubCategoryProduct');
    Route::get('product/subCategory/slug/{slug}', 'ProductController@showSubCategoryProductWhereSlug');
    Route::get('product/division/{division}', 'ProductController@showDivisionProduct');
    Route::get('product/division/slug/{slug}', 'ProductController@productWhereDivisionSlug');
    Route::get('product/brand/{brand}', 'ProductController@showBrandProduct');
    Route::get('product/brand/slug/{slug}', 'ProductController@showBrandProductWhereSlug');
    Route::get('product/{product}', 'ProductController@show');
    Route::get('product/slug/{slug}', 'ProductController@showWhereSlug');
    Route::get('product/get/featured    ', 'ProductController@featured');
    Route::get('product/get/new', 'ProductController@new');
    Route::get('product/get/top', 'ProductController@top');
    Route::get('product/get/hot', 'ProductController@hot');
    Route::get('product/related/{product}', 'ProductController@showRelatedProduct');
    Route::get('product/related/slug/{prodsluguct}', 'ProductController@showRelatedProductWhereSlug');
    Route::post('up-sale/products', 'ProductController@upSaleProduct');
    Route::post('cross-sale/products', 'ProductController@crossSaleProduct');
    Route::get('product/get/all', 'ProductController@showAllProductsByParams');
    Route::get('gift-set/products', 'ProductController@giftSet');

    # Search
    Route::post('search', 'ProductController@search');
    Route::get('search/attributes', 'FilterAttributeController@searchAttributes');
    Route::get('brand-attribute/{brand}', 'FilterAttributeController@brandAttribute');


    # SAB
    Route::get('sab/update-produts', 'SabController@updateProduts');

    # Settings
    Route::get('setting/free-delivery', 'SettingController@freeDelivery');
    Route::get('setting/dollar-to-iraqi', 'SettingController@dollarToIraqi');


    # Checkout
    Route::post('order/cart', 'OrderController@cart');

    # Customer auth
    Route::middleware(['api', 'multiauth:customer'])->group(function () {
        # profile
        Route::post('social/link', 'AuthController@linkSocialAccount');
        Route::post('change-password', 'AuthController@changePassword');
        Route::get('profile', 'AuthController@profile');
        Route::post('profile', 'AuthController@updateProfile');
        Route::post('profile/update-username', 'AuthController@updateUsername');

        Route::get('profile/check-if-need-to-update-phone', 'AuthController@checkIfNeedToUpdatePhoneNumber');

        # Auth
        Route::get('logout/other-devices', 'AuthController@logoutFromOtherDevices');
        Route::get('logout', 'AuthController@logout');

        # Notification & availability
        Route::get('notification', 'CustomerNotificationController@list');
        Route::get('notification/delete-all', 'CustomerNotificationController@deleteAll');
        Route::delete('notification/{customerNotification}', 'CustomerNotificationController@destroy');
        Route::post('receive-notification', 'CustomerNotificationController@receiveNotification');

        # Wishlist
        Route::get('wishlist/list', 'WishlistController@list');
        Route::post('wishlist', 'WishlistController@store');
        Route::delete('wishlist/{product}', 'WishlistController@destroy');

        # Favorite
        Route::get('favorite/list', 'FavoriteController@list');
        Route::post('favorite', 'FavoriteController@store');
        Route::delete('favorite/{product}', 'FavoriteController@destroy');

        # Order & checkout
        Route::get('order', 'OrderController@list');
        Route::get('order/search', 'OrderController@search');
        Route::post('order', 'OrderController@store');
        Route::post('re-order', 'OrderController@reOrder');
        Route::get('order/{order}', 'OrderController@show');

        # Reviews
        Route::post('review', 'ReviewController@store');
        Route::post('review/is-review', 'ReviewController@checkReview');

        # Address
        Route::get('address', 'CustomerAddressController@list');
        Route::get('address/{customerAddress}', 'CustomerAddressController@show');
        Route::post('address', 'CustomerAddressController@store');
        Route::put('address/{customerAddress}', 'CustomerAddressController@update');
        Route::get('address/{customerAddress}', 'CustomerAddressController@setIsActive');
        Route::delete('address/{customerAddress}', 'CustomerAddressController@destroy');
    });
});
