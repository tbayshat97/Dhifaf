<?php

use App\Models\BannerTranslation;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BannerTranslation::class, 10)->create();
    }
}
