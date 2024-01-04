<?php

use App\Models\GovernorateTranslation;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GovernorateTranslation::class, 5)->create();
    }
}
