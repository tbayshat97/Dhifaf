<?php

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(City::class, 20)->create();

        $cities_translations_rows = [
            ['id' => 1, 'city_id' => 1, 'locale' => 'en', 'name' => 'Al Anbar'],
            ['id' => 2, 'city_id'=> 2, 'local' => 'en' , 'name' => 'Babylon'],
            ['id' => 3, 'city_id'=> 3, 'local' => 'en' , 'name' => 'Baghdad'],
            ['id' => 4, 'city_id'=> 4, 'local' => 'en' , 'name' => 'Basra'],
            ['id' => 5, 'city_id'=> 5, 'local' => 'en' , 'name' => 'Dhi Qar'],
            ['id' => 6, 'city_id'=> 6, 'local' => 'en' , 'name' => 'Al-Qādisiyyah'],
            ['id' => 7, 'city_id'=> 7, 'local' => 'en' , 'name' => 'Diyala'],
            ['id' => 8, 'city_id'=> 8, 'local' => 'en' , 'name' => 'Duhok'],
            ['id' => 9, 'city_id'=> 9, 'local' => 'en' , 'name' => 'Erbil'],
            ['id' => 10, 'city_id'=> 10, 'local' => 'en' , 'name' => 'Halabja'],
            ['id' => 11, 'city_id'=> 11, 'local' => 'en' , 'name' => 'Karbala'],
            ['id' => 12, 'city_id'=> 12, 'local' => 'en' , 'name' => 'Kirkuk'],
            ['id' => 13, 'city_id'=> 13, 'local' => 'en' , 'name' => 'Maysan'],
            ['id' => 14, 'city_id'=> 14, 'local' => 'en' , 'name' => 'Muthanna'],
            ['id' => 15, 'city_id'=> 15, 'local' => 'en' , 'name' => 'Najaf'],
            ['id' => 16, 'city_id'=> 16, 'local' => 'en' , 'name' => 'Nineveh'],
            ['id' => 17, 'city_id'=> 17, 'local' => 'en' , 'name' => 'Saladin'],
            ['id' => 18, 'city_id'=> 18, 'local' => 'en' , 'name' => 'Sulaymaniyah'],
            ['id' => 19, 'city_id'=> 19, 'local' => 'en' , 'name' => 'As Samāwah'],
            ['id' => 20, 'city_id'=> 20, 'local' => 'en' , 'name' => 'Wasit'],
        ];

        DB::table('city_translations')->insert($cities_translations_rows);

        DB::table('city_translations')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
