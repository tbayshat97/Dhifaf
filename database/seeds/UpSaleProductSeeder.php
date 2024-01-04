<?php

use App\Models\UpSaleProduct;
use Illuminate\Database\Seeder;

class UpSaleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UpSaleProduct::class, 100)->create();
    }
}
