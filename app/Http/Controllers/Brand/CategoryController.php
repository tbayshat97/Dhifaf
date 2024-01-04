<?php

namespace App\Http\Controllers\brand;
use App\Models\Category;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\AddCategoryRequest;
use App\Http\Requests\Admin\OrderCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $brand = auth('brand')->user();

        $categories = $brand->categories();

        $breadcrumbs = [
            ['link' => "brand", 'name' => "Dashboard"], ['name' => "Categories"],
        ];

        $addNewBtn = "brand.brand-category.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend-brand.categories.list', compact('categories', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "brand", 'name' => "Dashboard"], ['link' => "brand/brand-category", 'name' => "Categories"], ['name' => "Create"]
        ];

        $divisions = Division::all();

        $pageConfigs = ['pageHeader' => true];
        return view('backend-brand.categories.add', compact(['langs', 'pageConfigs', 'breadcrumbs', 'divisions']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCategoryRequest $request)
    {
        try {
            $brand_category = new Category();

            $brand_category->image = $request->hasFile('image') ? uploadFile('brand_category', $request->file('image')) : null;
            $brand_category->header = $request->hasFile('header') ? uploadFile('brand_category', $request->file('header')) : null;
            $brand_category->is_active = ($request->has('is_active')) ? true : false;
            $brand_category->division_id = $request->division_id;
            $brand_category->brand_id = auth('brand')->user()->id;
            $brand_category->save();

            foreach ($this->lang as $lang) {
                $brand_category->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $brand_category->save();
            }

            return redirect(route('brand.brand-category.show', $brand_category))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $brand_category)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "brand", 'name' => "Dashboard"], ['link' => "brand/brand-category", 'name' => "Categories"], ['name' => "Update"]
        ];

        $divisions = Division::all();

        return view('backend-brand.categories.show', compact(['brand_category', 'langs', 'breadcrumbs', 'divisions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $brand_category)
    {
        try {
            $brand_category->image = $request->hasFile('image') ? uploadFile('brand_category', $request->file('image'), $brand_category->image) : $brand_category->image;
            $brand_category->header = $request->hasFile('header') ? uploadFile('brand_category', $request->file('header'), $brand_category->header) : $brand_category->header;

            $brand_category->is_active = ($request->has('is_active')) ? true : false;
            $brand_category->division_id = $request->division_id;
            $brand_category->save();

            foreach ($this->lang as $lang) {
                $brand_category->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $brand_category->save();
            }

            return redirect(route('brand.brand-category.show', $brand_category->id))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $brand_category)
    {
        $brand_category->delete();
        return redirect(route('brand.brand-category.index'))->with('success', __('system-messages.delete'));
    }
}
