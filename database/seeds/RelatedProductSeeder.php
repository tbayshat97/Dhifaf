<?php

use App\Models\RelatedProduct;
use Illuminate\Database\Seeder;

class RelatedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RelatedProduct::class, 100)->create();
    }
}
