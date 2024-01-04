<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddSubCategoryRequest;
use App\Http\Requests\Admin\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::orderBy('priority', 'asc')->get();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Sub Categories"],
        ];

        $addNewBtn = "admin.subCategory.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.subCategories.list', compact('subCategories', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/subCategory", 'name' => "Sub Categories"], ['name' => "Create"]
        ];

        $categories = Category::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $pageConfigs = ['pageHeader' => true];
        return view('backend.subCategories.add', compact(['langs', 'pageConfigs', 'breadcrumbs', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubCategoryRequest $request)
    {
        try {
            $subCategory = new SubCategory();

            $subCategory->image = $request->hasFile('image') ? uploadFile('subCategory', $request->file('image')) : null;
            $subCategory->header = $request->hasFile('header') ? uploadFile('subCategory', $request->file('header')) : null;
            $subCategory->is_active = ($request->has('is_active')) ? true : false;
            $subCategory->category_id = $request->category_id;
            $subCategory->save();

            foreach ($this->lang as $lang) {
                $subCategory->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $subCategory->save();
            }

            return redirect(route('admin.subCategory.show', $subCategory))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/subCategory", 'name' => "Sub Categories"], ['name' => "Update"]
        ];

        $categories = Category::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        return view('backend.subCategories.show', compact(['subCategory', 'langs', 'breadcrumbs', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        try {
            $subCategory->image = $request->hasFile('image') ? uploadFile('subCategory', $request->file('image'), $subCategory->image) : $subCategory->image;
            $subCategory->header = $request->hasFile('header') ? uploadFile('subCategory', $request->file('header'), $subCategory->header) : $subCategory->header;
            $subCategory->is_active = ($request->has('is_active')) ? true : false;
            $subCategory->category_id = $request->category_id;
            $subCategory->save();

            foreach ($this->lang as $lang) {
                $subCategory->translateOrNew($lang['code'])->slug = null;
                $subCategory->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $subCategory->save();
            }

            return redirect(route('admin.subCategory.show', $subCategory))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $products = Product::whereJsonContains('sub_categories', [$subCategory->id])->get();

        foreach ($products as $product) {
            $sub_categories =  $product->sub_categories && !is_null($product->sub_categories) ? json_decode($product->sub_categories) : [];

            if (count($sub_categories)) {
                if (($key = array_search($subCategory->id, $sub_categories)) !== false) {
                    unset($sub_categories[$key]);
                }
            }

            $product->sub_categories = count($sub_categories) ? json_encode(array_values($sub_categories)) : null;
            $product->save();
        }

        $subCategory->delete();
        return redirect(route('admin.subCategory.index'))->with('success', __('system-messages.delete'));
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
                $subCategory = SubCategory::find($indexes[$i]);
                $subCategory->priority = $i + 1;
                $subCategory->save();
            }

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
