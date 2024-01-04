<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $follow_us_rows = [
            ['id' => 1, 'key' => 'facebook', 'nice_name' => 'Facebook', 'link' => 'http://facebook.com'],
            ['id' => 2, 'key' => 'twitter', 'nice_name' => 'Twitter', 'link' => 'https://twitter.com'],
            ['id' => 3, 'key' => 'instagram', 'nice_name' => 'Instagram', 'link' => 'https://www.instagram.com'],
            ['id' => 4, 'key' => 'youtube', 'nice_name' => 'Youtube', 'link' => 'https://www.youtube.com/channel'],
        ];

        DB::table('follow_us')->insert($follow_us_rows);

        DB::table('follow_us')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
