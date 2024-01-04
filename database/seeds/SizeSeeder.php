<?php

use App\Models\SizeTranslation;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SizeTranslation::class, 30)->create();
    }
}
