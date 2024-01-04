<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_rows = [
            ['id' => 1, 'customer_id' => '1', 'order_number' => '123'],
            ['id' => 2, 'customer_id' => '2', 'order_number' => '321']
        ];
        DB::table('orders')->insert($order_rows);
        DB::table('orders')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $order_items_rows = [
            ['id' => 1, 'order_id' => '1', 'product_id' => '1','qty'=>'1','price'=>'58.60'],
            ['id' => 2, 'order_id' => '1', 'product_id' => '2','qty'=>'2','price'=>'18.65'],
            ['id' => 3, 'order_id' => '2', 'product_id' => '1','qty'=>'4','price'=>'58.60'],
        ];
        DB::table('order_items')->insert($order_items_rows);
        DB::table('order_items')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
