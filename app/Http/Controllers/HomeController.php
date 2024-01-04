<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BrandSlider;
use App\Models\BrandTranslation;
use App\Models\MainSlider;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\WebsitePage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function homePage()
    {
        $mainSliders = MainSlider::all();
        return view('website.index', compact('mainSliders'));
    }

    function about()
    {
        return view('website.about');
    }

    function login()
    {
        return view('website.auth.login');
    }

    function register()
    {
        return view('website.auth.register');
    }

    function verifySms()
    {
        return view('website.auth.verify');
    }

    function verifyForgotSms()
    {
        return view('website.auth.verify-forgot');
    }

    function forgotPassword()
    {
        return view('website.auth.forgot');
    }

    function resetPassword()
    {
        return view('website.auth.reset');
    }

    function division()
    {
        return view('website.categories.division');
    }

    function influencers()
    {
        return view('website.influencers.influencers');
    }

    function wishlist()
    {
        return view('website.products.wishlist');
    }

    function favorite()
    {
        return view('website.products.favorite');
    }

    function cart()
    {
        return view('website.products.cart');
    }

    function checkout()
    {
        return view('website.products.checkout');
    }

    function singleProduct($slug)
    {
        $product = ProductTranslation::where('slug', $slug)->first();
        return view('website.products.single-product', compact('product'));
    }

    function allProducts()
    {
        return view('website.products.all-products');
    }

    function saleAndOffers()
    {
        return view('website.products.sale-and-offers');
    }

    function categoryShop()
    {
        return view('website.categories.shop');
    }

    function brandShop()
    {
        return view('website.brands.shop');
    }

    function influencerShop()
    {
        return view('website.influencers.shop');
    }

    function newArrivals()
    {
        return view('website.products.new-arrivals');
    }

    // Luxury Functions
    function luxury($slug)
    {
        $brand = BrandTranslation::where('slug', $slug)->first();

        $brandSliders = BrandSlider::where('brand_id', $brand->id)->get();
        return view('website.luxury.home', compact('brandSliders'));
    }

    function luxuryShop()
    {
        return view('website.luxury.shop');
    }

    function luxurySingle()
    {
        return view('website.luxury.single');
    }

    // Static Pages
    function privacyPolicy()
    {
        $data = WebsitePage::where('id', 2)->first();
        return view('website.static-pages.privacy-policy', compact('data'));
    }

    function termsAndConditions()
    {
        $data = WebsitePage::where('id', 1)->first();
        return view('website.static-pages.terms-and-conditions', compact('data'));
    }

    function faqs()
    {
        $data = WebsitePage::where('id', 6)->first();
        return view('website.static-pages.faqs', compact('data'));
    }

    function returnPolicy()
    {
        $data = WebsitePage::where('id', 4)->first();
        return view('website.static-pages.return-policy', compact('data'));
    }

    function sitemap()
    {
        $data = WebsitePage::where('id', 5)->first();
        return view('website.static-pages.sitemap', compact('data'));
    }

    function contactUs()
    {
        return view('website.static-pages.contact-us');
    }

    function gallery()
    {
        return view('website.gallery');
    }

    function galleryPage()
    {
        return view('website.gallery-page');
    }

    function brands()
    {
        return view('website.brands.brands');
    }

    public function showBrand()
    {
        return view('website.brands.show');
    }

    function myProfile()
    {
        return view('website.profile.my-profile');
    }

    function updateUsername()
    {
        return view('website.profile.update-username');
    }

    function verifyUpdate()
    {
        return view('website.profile.verify-update');
    }

    function myOrders()
    {
        return view('website.profile.my-orders');
    }

    function manageAddress()
    {
        return view('website.profile.manage-address');
    }

    function notifications()
    {
        return view('website.profile.notifications');
    }

    public function products()
    {
        return view('website.shop.products');
    }

    function giftSets()
    {
        return view('website.products.gift-sets');
    }
    function hotItems()
    {
        return view('website.products.hot-items');
    }
}
