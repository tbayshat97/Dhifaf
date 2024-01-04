<?php

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Area::class, 1)->create();

        $areas_translations_rows = [
            ['id' => 1, 'area_id' => 1, 'locale' => 'en', 'name' => 'Kadhimiyah'],
        ];

        DB::table('area_translations')->insert($areas_translations_rows);

        DB::table('area_translations')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
