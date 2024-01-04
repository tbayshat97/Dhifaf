<?php

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Country::class, 1)->create();

        $countries_translations_rows = [
            ['id' => 1, 'country_id' => 1, 'locale' => 'en', 'name' => 'Iraq'],
        ];

        DB::table('country_translations')->insert($countries_translations_rows);

        DB::table('country_translations')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
