<?php

use Illuminate\Database\Seeder;
use App\Models\DivisionTranslation;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DivisionTranslation::class, 10)->create();
    }
}
