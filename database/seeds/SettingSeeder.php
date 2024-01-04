<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings_rows = [
            ['id' => 1, 'option_name' => 'Free delivery - on all orders over ', 'option_key' => 'free_delivery_over', 'option_value' => 60],
            ['id' => 2, 'option_name' => 'Minimum qty for all products',  'option_key' => 'minimum_qty', 'option_value' => 50],
            ['id' => 3, 'option_name' => 'Dollar to Iraqi Dinar Rate',  'option_key' => 'dollar_to_iraqi', 'option_value' => 50],
        ];

        DB::table('settings')->insert($settings_rows);

        DB::table('settings')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
