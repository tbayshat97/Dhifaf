<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\CategoryDivision;
use App\Models\SubCategory;
use App\Models\SubCategoryTranslation;
use App\Models\CategoryTranslation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubCategoriesImport implements ToModel, WithHeadingRow
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
        $rootName = $row["root"];
        $category = CategoryTranslation::where('name', $rootName)->first();
        //dd($division);
        if ($category) {
            $categoryName = $row["name_en"];
            //dd($categoryName);
            if (!is_null($categoryName)) {
                $categoryTitle = SubCategoryTranslation::where('name', $categoryName)->first();
                if ($categoryTitle) {
                    $subCategory = SubCategory::where('id', $categoryTitle->sc_id)->first();
                    foreach ($this->lang as $lang) {
                        $subCategory->translateOrNew($lang['code'])->name = $row['name_' . $lang['code']];
                    }
                    //$subCategory->category_id = $category->id;
                    $subCategory->save();
                } else {
                    $subCategory = new SubCategory();
                    $subCategory->image = null;
                    $subCategory->header = null;
                    $subCategory->is_active = true;
                    $subCategory->category_id = $category->category_id;
                    $subCategory->save();
                    foreach ($this->lang as $lang) {
                        $subCategory->translateOrNew($lang['code'])->name = $row['name_' . $lang['code']];
                    }
                    $subCategory->save();
                }
            }
        }








        //$category->save();
    }
}
