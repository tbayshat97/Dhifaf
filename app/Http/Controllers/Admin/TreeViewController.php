<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCategoryRequest;
use App\Models\Category;
use App\Models\CategoryDivision;
use App\Models\Division;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Http\Request;

class TreeViewController extends Controller
{
    public function index()
    {
        $divisions = Division::get();
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $brands = Brand::whereNull('parent_brand_id')->get();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Tree View"],
        ];


        $pageConfigs = ['pageHeader' => true];

        return view('backend.tree.list', compact('divisions', 'brands', 'categories', 'subcategories', 'langs', 'pageConfigs', 'breadcrumbs'));
    }
    public function getCategories(Division $division)
    {
        $data = $division->categories();

        return $data;
    }
}
