<?php

use App\Models\Influencer;
use App\Models\Course;
use App\Models\Customer;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Favorite::class, 30)->create();
    }
}
