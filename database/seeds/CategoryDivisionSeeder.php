<?php

use App\Models\CategoryDivision;
use Illuminate\Database\Seeder;

class CategoryDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CategoryDivision::class, 30)->create();
    }
}
