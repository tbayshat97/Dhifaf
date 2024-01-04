<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::whereNull('parent_brand_id')->orderBy('priority', 'asc')->get();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Brands"],
        ];

        $addNewBtn = "admin.brand.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.brands.list', compact('brands', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/brand", 'name' => "Brands"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend.brands.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBrandRequest $request)
    {
        try {
            $brand = new Brand();

            $brand->image = $request->hasFile('image') ? uploadFile('brand', $request->file('image')) : null;
            $brand->header = $request->hasFile('header') ? uploadFile('brand', $request->file('header')) : null;
            $brand->is_active = ($request->has('is_active')) ? true : false;
            $brand->status = ($request->has('status')) ? 2 : 1;
            $brand->username = $request->username;
            $brand->account_verified_at = Carbon::now();
            $brand->password = bcrypt($request->password);
            $brand->save();

            foreach ($this->lang as $lang) {
                $brand->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $brand->save();
            }

            return redirect(route('admin.brand.show', $brand))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/brand", 'name' => "Brands"], ['name' => "Update"]
        ];

        return view('backend.brands.show', compact(['brand', 'langs', 'breadcrumbs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        try {
            $brand->image = $request->hasFile('image') ? uploadFile('brand', $request->file('image'), $brand->image) : $brand->image;
            $brand->header = $request->hasFile('header') ? uploadFile('brand', $request->file('header'), $brand->header) : $brand->header;
            $brand->is_active = ($request->has('is_active')) ? true : false;
            $brand->status = ($request->has('status')) ? 2 : 1;
            $brand->username = $request->username;
            if ($request->password) {
                $brand->password = bcrypt($request->password);
            }
            $brand->save();

            foreach ($this->lang as $lang) {
                $brand->translateOrNew($lang['code'])->slug = null;
                $brand->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $brand->save();
            }

            return redirect(route('admin.brand.show', $brand))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect(route('admin.brand.index'))->with('success', __('system-messages.delete'));
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
                $brand = Brand::find($indexes[$i]);
                $brand->priority = $i + 1;
                $brand->save();
            }
            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
