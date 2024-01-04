<?php

use App\Models\DriverProfile;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DriverProfile::class, 10)->create();
    }
}
