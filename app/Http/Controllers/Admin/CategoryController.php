<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCategoryRequest;
use App\Models\Category;
use App\Models\CategoryDivision;
use App\Models\Division;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('priority', 'asc')->get();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Categories"],
        ];

        $addNewBtn = "admin.category.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.categories.list', compact('categories', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/category", 'name' => "Categories"], ['name' => "Create"]
        ];

        $divisions = Division::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $pageConfigs = ['pageHeader' => true];

        return view('backend.categories.add', compact(['langs', 'pageConfigs', 'breadcrumbs', 'divisions']));
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
            $category = new Category();

            $category->image = $request->hasFile('image') ? uploadFile('category', $request->file('image')) : null;
            $category->header = $request->hasFile('header') ? uploadFile('category', $request->file('header')) : null;
            $category->is_active = ($request->has('is_active')) ? true : false;
            $category->save();

            foreach ($this->lang as $lang) {
                $category->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $category->save();
            }

            foreach ($request->divisions as $division) {
                $categoryDivision = new CategoryDivision();
                $categoryDivision->category_id = $category->id;
                $categoryDivision->division_id = (int) $division;
                $categoryDivision->save();
            }

            return redirect(route('admin.category.show', $category))->with('success', __('system-messages.add'));
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
    public function show(Category $category)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/category", 'name' => "Categories"], ['name' => "Update"]
        ];

        $divisions = Division::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $selectedDivisions = $category->divisons()->pluck('division_id')->toArray();

        return view('backend.categories.show', compact(['category', 'langs', 'breadcrumbs', 'divisions', 'selectedDivisions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $category->image = $request->hasFile('image') ? uploadFile('category', $request->file('image'), $category->image) : $category->image;
            $category->header = $request->hasFile('header') ? uploadFile('category', $request->file('header'), $category->header) : $category->header;
            $category->is_active = ($request->has('is_active')) ? true : false;
            $category->save();

            foreach ($this->lang as $lang) {
                $category->translateOrNew($lang['code'])->slug = null;
                $category->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $category->save();
            }

            if ($request->has('divisions')) {
                CategoryDivision::where('category_id', $category->id)->whereNotIn('division_id', $request->divisions)->delete();
                $selectedDivisions = $category->divisons()->pluck('division_id')->toArray();

                foreach ($request->divisions as $division) {
                    if (!in_array($division, $selectedDivisions)) {
                        $categoryDivision = new CategoryDivision();
                        $categoryDivision->category_id = $category->id;
                        $categoryDivision->division_id = (int) $division;
                        $categoryDivision->save();
                    }
                }
            }

            return redirect(route('admin.category.show', $category))->with('success', __('system-messages.update'));
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
    public function destroy(Category $category)
    {
        $products = Product::whereJsonContains('categories', [$category->id])->get();

        $subs = $category->sub()->get()->pluck('id')->toArray();

        foreach ($products as $product) {
            $categories =  json_decode($product->categories);
            $sub_categories =  $product->sub_categories && !is_null($product->sub_categories) ? json_decode($product->sub_categories) : [];

            if (($key = array_search($category->id, $categories)) !== false) {
                unset($categories[$key]);
            }

            if (count($sub_categories)) {
                foreach ($subs as $key => $sub) {
                    if (($key = array_search($sub, $sub_categories)) !== false) {
                        unset($sub_categories[$key]);
                    }
                }
            }

            $product->categories = count($categories) ? json_encode(array_values($categories)) : null;
            $product->sub_categories = count($sub_categories) ? json_encode(array_values($sub_categories)) : null;
            $product->save();
        }

        $category->delete();
        return redirect(route('admin.category.index'))->with('success', __('system-messages.delete'));
    }

    public function saveOrder(Request $request)
    {
        $validations = [
            'orders' => 'required|json',
            'orders.*' => 'integer',
        ];
        $request->validate($validations);

        try {
            $indexes = json_decode($request->orders);
            for ($i = 0; $i < count($indexes); $i++) {
                $category = Category::find($indexes[$i]);
                $category->priority = $i + 1;
                $category->save();
            }
            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
