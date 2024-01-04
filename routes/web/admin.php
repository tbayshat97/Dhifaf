<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/login', 'Auth\AuthController@showLoginForm')->name('login_form');
    Route::post('/login', 'Auth\AuthController@login')->name('login');
    Route::get('forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
        Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

        #Admin profile routes
        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::post('/profile/update', 'UserController@updateProfile')->name('profile.update');
    });

    #Walkthrough routes
    Route::middleware(['auth:admin', 'permission:walkthrough management'])->group(function () {
        Route::resource('walkthrough', 'WalkthroughController')->name('*', 'walkthrough');
    });

    #Static pages routes
    Route::middleware(['auth:admin', 'permission:staticPage management'])->group(function () {
        Route::resource('staticPage', 'StaticPageController')->name('*', 'staticPage');
        #App Slider routes
        Route::resource('app-slider', 'MainSliderController')->name('*', 'app-slider');
    });

    #Roles routes
    Route::middleware(['auth:admin', 'permission:roles'])->group(function () {
        Route::get('roles/users', 'AdminRoleController@users')->name('roles.users');
        Route::get('roles/users/{user}/edit', 'AdminRoleController@usersEdit')->name('roles.users.edit');
        Route::put('roles/users/{user}/edit', 'AdminRoleController@usersUpdate')->name('roles.users.save');
        Route::resource('roles', 'AdminRoleController')->name('*', 'roles');
    });

    #Administration routes
    Route::middleware(['auth:admin', 'permission:admin management'])->group(function () {
        Route::resource('administration', 'UserController')->name('*', 'administration');
    });

    #Customers routes
    Route::middleware(['auth:admin', 'permission:customers management'])->group(function () {
        Route::resource('customer', 'CustomerController')->name('*', 'customer');
        Route::get('subscribers', 'CustomerController@subscribers')->name('customer.subscribers');
    });

    #Chats routes
    Route::middleware(['auth:admin', 'permission:chat management'])->group(function () {
        Route::get('chat', 'DialogController@chat')->name('chat');
        Route::get('chat/{dialog}', 'DialogController@chatMessages')->name('chat.messages');
        Route::get('read/chat/{dialog}', 'DialogController@readAll')->name('chat.messages.read');
        Route::get('chat-sidebar', 'DialogController@sidebar')->name('chat.sidebar');
        Route::post('chat/send-message/{dialog}', 'DialogController@sendMessage')->name('chat.send.message');
    });

    #Notifications routes
    Route::middleware(['auth:admin', 'permission:notifications management'])->group(function () {
        Route::post('send-notification', 'SendNotificationController@send')->name('send-notification');
        Route::get('send-notification', 'SendNotificationController@sendNotificationPage')->name('send-notification-page');
    });

    Route::middleware(['auth:admin', 'permission:influencers management'])->group(function () {
        Route::resource('influencer', 'InfluencerController')->name('*', 'influencer');
    });

    Route::middleware(['auth:admin', 'permission:categories management'])->group(function () {
        Route::resource('category', 'CategoryController')->name('*', 'category');
        Route::post('category/order', 'CategoryController@saveOrder')->name('category.order.save');
    });

    Route::middleware(['auth:admin', 'permission:brands management'])->group(function () {
        Route::resource('brand', 'BrandController')->name('*', 'brand');
        Route::post('brand/order', 'BrandController@saveOrder')->name('brand.order.save');


        #SubBrand
        Route::get('/sub-brand', 'SubBrandController@index')->name('sub-brand.index');
        Route::get('/sub-brand/create', 'SubBrandController@create')->name('sub-brand.create');
        Route::get('/sub-brand/{subBrand?}', 'SubBrandController@show')->name('sub-brand.show');
        Route::post('/sub-brand/store', 'SubBrandController@store')->name('sub-brand.store');
        Route::get('/edit-sub-brand/{subBrand?}', 'SubBrandController@edit')->name('sub-brand.edit');
        Route::put('/update-sub-brand/{subBrand?}', 'SubBrandController@update')->name('sub-brand.update');
        Route::delete('/destroy-sub-brand/{subBrand?}', 'SubBrandController@destroy')->name('sub-brand.destroy');
    });

    Route::middleware(['auth:admin', 'permission:divisions management'])->group(function () {
        Route::resource('division', 'DivisionController')->name('*', 'division');
        Route::post('division/order', 'DivisionController@saveOrder')->name('division.order.save');
        Route::get('division/banner/{division}', 'DivisionController@banner')->name('division.banner');
        Route::post('division/banner/{division}', 'DivisionController@bannerStore')->name('division.banner.store');
    });

    Route::middleware(['auth:admin', 'permission:sub-categories management'])->group(function () {
        Route::resource('subCategory', 'SubCategoryController')->name('*', 'subCategory');
        Route::post('subCategory/order', 'SubCategoryController@saveOrder')->name('subCategory.order.save');
        Route::get('/tree-view', 'TreeViewController@index')->name('tree.index');
        Route::get('/tree-view/categories/{division}', 'TreeViewController@getCategories')->name('tree.categories');
        Route::get('/tree-view/subcategories/{category}', 'TreeViewController@getSubcategories')->name('tree.subcategories');
    });

    Route::middleware(['auth:admin', 'permission:products management'])->group(function () {
        Route::resource('product', 'ProductController')->name('*', 'product');
        Route::get('product/list/ajax', 'ProductController@ajax')->name('product.ajax');
        Route::post('category/sub', 'ProductController@subCategories')->name('category.sub');
        Route::post('brand/sub', 'ProductController@subBrands')->name('brand.sub');

        Route::get('sub-product/show/{product}', 'ProductController@subProductShow')->name('sub-product.show');

        Route::post('sub-product/update/{product}', 'ProductController@subProductUpdate')->name('sub-product.update');


        Route::get('product-variation/{product}', 'ProductVariationController@show')->name('product-variation.show');
        Route::post('product-variation/{product}', 'ProductVariationController@store')->name('product-variation.add');
        Route::get('product-combination/{product}', 'ProductCombinationController@index')->name('product-combination.index');

        Route::get('product-combination/show/{productCombination}', 'ProductCombinationController@show')->name('product-combination.show');
        Route::put('product-combination/{productCombination}', 'ProductCombinationController@update')->name('product-combination.update');
        Route::delete('product-combination/{productCombination}', 'ProductCombinationController@destroy')->name('product-combination.destroy');

        Route::get('related-product/show/{product}', 'ProductController@relatedProductShow')->name('related-product.show');
        Route::get('related-product/show/products/ajax/{product}', 'ProductController@relatedDataAjax')->name('related-product.ajax.show');
        Route::post('related-product/update/{product}', 'ProductController@relatedProductUpdate')->name('related-product.update');
        Route::delete('related-product/delete/{related}', 'ProductController@relatedProductDelete')->name('related-product.destroy');

        Route::get('cross-sale-product/show/{product}', 'ProductController@crossSaleProductShow')->name('cross-sale-product.show');
        Route::get('cross-sale-product/show/products/ajax/{product}', 'ProductController@crossDataAjax')->name('cross-sale-product.ajax.show');
        Route::post('cross-sale-product/update/{product}', 'ProductController@crossSaleProductUpdate')->name('cross-sale-product.update');
        Route::delete('cross-sale-product/delete/{crossSale}', 'ProductController@crossSaleProductDelete')->name('cross-sale-product.destroy');

        Route::get('up-sale-product/show/{product}', 'ProductController@upSaleProductShow')->name('up-sale-product.show');
        Route::get('up-sale-product/show/products/ajax/{product}', 'ProductController@upDataAjax')->name('up-sale-product.ajax.show');
        Route::post('up-sale-product/update/{product}', 'ProductController@upSaleProductUpdate')->name('up-sale-product.update');
        Route::delete('up-sale-product/delete/{upSale}', 'ProductController@upSaleProductDelete')->name('up-sale-product.destroy');

        Route::get('group-product/show/{product}', 'ProductController@groupProductShow')->name('group-product.show');
        Route::get('group-product/show/products/ajax/{product}', 'ProductController@groupDataAjax')->name('group-product.ajax.show');
        Route::post('group-product/update/{product}', 'ProductController@groupProductUpdate')->name('group-product.update');
        Route::post('group-product/default', 'ProductController@groupProductDefault')->name('group-product.default');

        Route::delete('group-product/delete/{product}', 'ProductController@groupProductDelete')->name('group-product.destroy');

        Route::resource('size', 'SizeController')->name('*', 'product');

        Route::resource('color', 'ColorController')->name('*', 'product');

        Route::get('product/list/reviews/{product}', 'ProductController@reviews')->name('product.reviews');
        Route::get('list/featured-products', 'ProductController@featured')->name('product.featured');
        Route::get('list/on-sale-products', 'ProductController@onSaleProducts')->name('product.onSaleProducts');
        Route::get('list/new_arrival', 'ProductController@newArrival')->name('product.new');
    });

    Route::middleware(['auth:admin', 'permission:coupons management'])->group(function () {
        Route::resource('coupon', 'CouponController')->name('*', 'coupon');
    });

    Route::middleware(['auth:admin', 'permission:addresses management'])->group(function () {
        Route::resource('country', 'CountryController')->name('*', 'country');
        Route::resource('city', 'CityController')->name('*', 'city');
        Route::resource('area', 'AreaController')->name('*', 'area');
        Route::get('cities', 'AreaController@getAjaxCity')->name('area.load-cities');
        Route::resource('governorate', 'GovernorateController')->name('*', 'governorate');
    });

    Route::middleware(['auth:admin', 'permission:driver management'])->group(function () {
        Route::resource('driver', 'DriverController')->name('*', 'driver');
    });

    Route::middleware(['auth:admin', 'permission:site management'])->group(function () {
        #Website Slider routes
        Route::resource('main-slider', 'MainSliderController')->name('*', 'main-slider');

        #FAQ
        Route::resource('faq', 'FaqController')->name('*', 'faq');

        #Social Media Links routes
        Route::get('/social-media', 'FollowUsController@index')->name('social-media.index');
        Route::get('/social-media/{followUs}', 'FollowUsController@show')->name('social-media.show');
        Route::put('/social-media/{followUs}', 'FollowUsController@update')->name('social-media.update');
        Route::delete('/social-media/{followUs}', 'FollowUsController@destroy')->name('social-media.delete');

        #Website Pages routes
        Route::resource('website-page', 'WebsitePageController')->name('*', 'website-page');
        Route::get('section-header', 'SectionController@headerShow')->name('section-header');
        Route::put('section-header-update/{section}', 'SectionController@headerUpdate')->name('section-header-update');
        Route::get('section-footer', 'SectionController@footerShow')->name('section-footer');
        Route::put('section-footer-update/{section}', 'SectionController@footerUpdate')->name('section-footer-update');

        #Website about-us page routes
        Route::get('about-section-one', 'AboutSectionController@sectionOneShow')->name('about-section-one');
        Route::put('about-section-one-update/{aboutSection}', 'AboutSectionController@sectionOneUpdate')->name('about-section-one-update');
        Route::get('about-section-two', 'AboutSectionController@sectiontwoShow')->name('about-section-two');
        Route::put('about-section-two-update/{aboutSection}', 'AboutSectionController@sectionTwoUpdate')->name('about-section-two-update');
        Route::get('about-section-three', 'AboutSectionController@sectionThreeShow')->name('about-section-three');
        Route::put('about-section-three-update/{aboutSection}', 'AboutSectionController@sectionThreeUpdate')->name('about-section-three-update');

        #Website about-us gallery routes
        Route::resource('gallery', 'GalleryController')->name('*', 'gallery');

        #Website contact-us routes
        Route::resource('contact', 'ContactController')->name('*', 'contact');

        #Banner routes
        Route::resource('banner', 'BannerController')->name('*', 'banner');

        #App Slider routes
        Route::resource('app-slider', 'MainSliderController')->name('*', 'app-slider');
    });

    #Orders routes
    Route::middleware(['auth:admin', 'permission:orders management'])->group(function () {
        Route::resource('order', 'OrderController')->name('*', 'order');
    });

    #Settings routes
    Route::middleware(['auth:admin', 'permission:settings management'])->group(function () {
        Route::get('setting', 'SettingController@show')->name('setting');
        Route::put('setting', 'SettingController@save')->name('setting.save');
    });

    #qoutes route
    Route::middleware(['auth:admin', 'permission:qoutes management'])->group(function () {
        Route::get('quotes', 'QuoteController@index');
    });

    #tools route
    Route::middleware(['auth:admin', 'permission:tools management'])->group(function () {
        Route::get('import/sab/products', 'ToolController@importProductsSab');
        Route::get('import/excel/products', 'ToolController@importProductsExcel');
        Route::post('import/excel/products', 'ToolController@updateImportedProducts')->name('import-products.update');
        Route::get('import/excel/sizes', 'ToolController@importSizesExcel');
        Route::post('import/excel/sizes', 'ToolController@addImportedSizes')->name('import-sizes.add');
        Route::post('import/excel/categories', 'ToolController@addImportedCategories')->name('import-categories.add');
        Route::post('import/excel/subcategories', 'ToolController@addImportedSubCategories')->name('import-subcategories.add');
    });

    #tools route
    Route::middleware(['auth:admin', 'permission:tools management'])->group(function () {
        Route::get('import/sap/products', 'ToolController@importProductsSap');
        Route::get('import/excel/products', 'ToolController@importProductsExcel');
        Route::post('import/excel/products', 'ToolController@updateImportedProducts')->name('import-products.update');
    });

    #tools route
    Route::middleware(['auth:admin', 'permission:file manager management'])->group(function () {
        Route::get('/file-manager', 'ToolController@fileManager')->name('file-manager');
    });
});
