<?php

use App\Models\DivisionBanner;
use App\Models\DivisionBannerTranslation;
use Illuminate\Database\Seeder;

class DivisionBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DivisionBannerTranslation::class, 10)->create();

        for ($i = 1; $i <= 10; $i++) {
            $banner = DivisionBanner::find($i);
            $banner->division_id = $i;
            $banner->save();
        }
    }
}
