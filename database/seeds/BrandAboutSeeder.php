<?php

use App\Models\BrandAboutTranslation;
use Illuminate\Database\Seeder;

class BrandAboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BrandAboutTranslation::class, 1)->create();

    }
}
