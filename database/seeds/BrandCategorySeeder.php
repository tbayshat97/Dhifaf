<?php

use App\Models\BrandCategory;
use Illuminate\Database\Seeder;

class BrandCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BrandCategory::class, 30)->create();
    }
}
