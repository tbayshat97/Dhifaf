<?php

use App\Models\ColorTranslation;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ColorTranslation::class, 30)->create();
    }
}
