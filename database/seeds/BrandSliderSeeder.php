<?php

use App\Models\BrandSliderTranslation;
use Illuminate\Database\Seeder;

class BrandSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BrandSliderTranslation::class, 10)->create();
    }
}
