<?php

use App\Models\CrossSaleProduct;
use Illuminate\Database\Seeder;

class CrossSaleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CrossSaleProduct::class, 100)->create();
    }
}
