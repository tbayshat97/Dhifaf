<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDirectories();

        if (App::environment() === 'production') {
            echo ("Production mode seeding \n");
            $this->call($this->getProductionModeSeeders());
        } else {
            echo ("Development mode seeding \n");

            $productionSeeders = $this->getProductionModeSeeders();
            $developmentSeeders = $this->getDevelopmentModeSeeders();

            $seeders = array_merge($productionSeeders, $developmentSeeders);

            $this->call($seeders);
        }
    }

    public function cleanDirectories()
    {
        echo ("Cleaning Directories\n");
        $file = new Filesystem;

        $file->cleanDirectory('storage/app/public/customer');
        $file->cleanDirectory('storage/app/public/mainSlider');
        $file->cleanDirectory('storage/app/public/walkthrough');
    }

    public function getProductionModeSeeders()
    {
        return [
            TruncateAllTables::class,
            PassportSeeder::class,
            RolesTableSeeder::class,
            UserSeeder::class,
            WalkthroughSeeder::class,
            StaticPageSeeder::class,
            MainSliderSeeder::class,
            ContactSeeder::class,
        ];
    }

    public function getDevelopmentModeSeeders()
    {
        return [
            CountrySeeder::class,
            GovernorateSeeder::class,
            CitySeeder::class,
            AreaSeeder::class,
            CustomerSeeder::class,
            MainSliderSeeder::class,
            WebsitePageSeeder::class,
            DialogSeeder::class,
            InfluencerSeeder::class,
            BrandSeeder::class,
            DivisionSeeder::class,
            CategorySeeder::class,
            CategoryDivisionSeeder::class,
            SubCategorySeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
            BannerSeeder::class,
            WebsiteSliderSeeder::class,
            WebsiteSliderImageSeeder::class,
            FollowUsSeeder::class,
            BrandBannerSeeder::class,
            BrandSliderSeeder::class,
            CurrencySeeder::class,
            DriverSeeder::class,
            OrderSeeder::class,
            BrandAboutSeeder::class,
            WishlistSeeder::class,
            FavoriteSeeder::class,
            CustomerNotificationSeeder::class,
            SectionSeeder::class,
            AboutSectionSeeder::class,
            GallerySeeder::class,
            QuoteSeeder::class,
            FaqSeeder::class,
            CustomerAddressSeeder::class,
            CouponSeeder::class,
            CrossSaleProductSeeder::class,
            RelatedProductSeeder::class,
            UpSaleProductSeeder::class,
            BrandCategorySeeder::class,
            InfluencerProductSeeder::class,
            SettingSeeder::class,
            DivisionBannerSeeder::class
        ];
    }
}
