<?php
use App\Models\SubCategory;
use App\Models\SubCategoryTranslation;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SubCategoryTranslation::class, 10)->create();
    }
}
