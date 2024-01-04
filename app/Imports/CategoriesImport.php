<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\CategoryDivision;
use App\Models\Division;
use App\Models\DivisionTranslation;
use App\Models\CategoryTranslation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToModel, WithHeadingRow
{
    public $lang = [
        ['name' => 'english', 'code' => 'en'],
        ['name' => 'arabic', 'code' => 'ar'],
    ];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $categoryName = $row["name_en"];
        $categoryTitle = CategoryTranslation::where('name', $categoryName)->first();
        if ($categoryTitle) {
            $category = Category::where('id', $categoryTitle->category_id)->first();
            foreach ($this->lang as $lang) {
                $category->translateOrNew($lang['code'])->name = $row['name_' . $lang['code']];
                $category->save();
            }
        } else {
            $category = new Category();
            $category->image = null;
            $category->header = null;
            $category->is_active = true;
            $category->save();
            foreach ($this->lang as $lang) {
                $category->translateOrNew($lang['code'])->name = $row['name_' . $lang['code']];
                $category->save();
            }
        }



        $divisionName = $row["division"];
        $division = DivisionTranslation::where('name', $divisionName)->first();
        //dd($division);
        if ($division) {
            $categoryDivision = new CategoryDivision();
            $categoryDivision->category_id = $category->id;
            $categoryDivision->division_id = $division->division_id;
            $categoryDivision->save();
        }


        //$category->save();
    }
}
