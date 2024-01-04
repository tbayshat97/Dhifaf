<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // get all data from menu.json file
        $verticalMenuJson = file_get_contents(base_path('resources/json/verticalMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);
        $horizontalMenuJson = file_get_contents(base_path('resources/json/horizontalMenu.json'));
        $horizontalMenuData = json_decode($horizontalMenuJson);

        // get all influencer data from menu.json file
        $verticalMenuJsonInfluencer = file_get_contents(base_path('resources/json/verticalMenu-influencer.json'));
        $verticalMenuDataInfluencer = json_decode($verticalMenuJsonInfluencer);
        $horizontalMenuJsonInfluencer = file_get_contents(base_path('resources/json/horizontalMenu-influencer.json'));
        $horizontalMenuDataInfluencer = json_decode($horizontalMenuJsonInfluencer);

        // get all Brand data from menu.json file
        $verticalMenuJsonBrand = file_get_contents(base_path('resources/json/verticalMenu-brand.json'));
        $verticalMenuDataBrand = json_decode($verticalMenuJsonBrand);
        $horizontalMenuJsonBrand = file_get_contents(base_path('resources/json/horizontalMenu-brand.json'));
        $horizontalMenuDataBrand = json_decode($horizontalMenuJsonBrand);

        // share all menuData to all the views
        \View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
        \View::share('menuDataInfluencer', [$verticalMenuDataInfluencer, $horizontalMenuDataInfluencer]);
        \View::share('menuDataBrand', [$verticalMenuDataBrand, $horizontalMenuDataBrand]);
    }
}
