<?php

use App\Models\InfluencerProduct;
use Illuminate\Database\Seeder;

class InfluencerProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(InfluencerProduct::class, 20)->create();
    }
}
