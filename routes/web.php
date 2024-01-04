<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::get('/', [HomeController::class, 'homePage'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::get('/verify-sms', [HomeController::class, 'verifySms'])->name('verify-sms');
Route::get('/forgot-password', [HomeController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/verify-forgot', [HomeController::class, 'verifyForgotSms'])->name('verify-forgot');
Route::get('/reset-password', [HomeController::class, 'resetPassword'])->name('reset-password');

// Static Pages Routes
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/return-policy', [HomeController::class, 'returnPolicy'])->name('return-policy');
Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/sitemap', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::get('/gallery/{gallery}', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/gallery-page', [HomeController::class, 'galleryPage'])->name('gallery-page');

// Categories Routes
Route::get('/division/{division}', [HomeController::class, 'division'])->name('division');

// Influencers Routes
Route::get('/influencers', [HomeController::class, 'influencers'])->name('influencers');

// Luxury Routes
Route::get('/luxury/{slug}', [HomeController::class, 'luxury'])->name('luxury');
Route::get('/luxury-shop', [HomeController::class, 'luxuryShop'])->name('luxury-shop');
Route::get('/luxury-single', [HomeController::class, 'luxurySingle'])->name('luxury-single');

// Products Routes
Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist');
Route::get('/favorite', [HomeController::class, 'favorite'])->name('favorite');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/single-product/{slug}', [HomeController::class, 'singleProduct'])->name('single-product');
Route::get('/category-shop/{id}', [HomeController::class, 'categoryShop'])->name('category-shop');
Route::get('/brand-shop/{slug}', [HomeController::class, 'brandShop'])->name('brand-shop');
Route::get('/influencer-shop/{id}', [HomeController::class, 'influencerShop'])->name('influencer-shop');

Route::get('/all-products', [HomeController::class, 'allProducts'])->name('all-products');
Route::get('/sale-and-offers', [HomeController::class, 'saleAndOffers'])->name('sale-and-offers');

Route::get('/brands', [HomeController::class, 'brands'])->name('brands');
Route::get('/brands/{slug}', [HomeController::class, 'showBrand'])->name('show-brand');

// Profile Pages
Route::get('/my-profile', [HomeController::class, 'myProfile'])->name('my-profile');
Route::get('/my-orders', [HomeController::class, 'myOrders'])->name('my-orders');
Route::get('/manage-address', [HomeController::class, 'manageAddress'])->name('manage-address');
Route::get('/notifications', [HomeController::class, 'notifications'])->name('notifications');
Route::get('/update-username', [HomeController::class, 'updateUsername'])->name('update-username');
Route::get('/verify-update', [HomeController::class, 'verifyUpdate'])->name('verify-update');

Route::get('/new-arrivals', [HomeController::class, 'newArrivals'])->name('new-arrivals');
Route::get('/gift-sets', [HomeController::class, 'giftSets'])->name('giftSets');
Route::get('/hot-items', [HomeController::class, 'hotItems'])->name('hotItems');
