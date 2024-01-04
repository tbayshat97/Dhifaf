<?php

namespace App\Http\Controllers\brand;

use App\Enums\BrandType;
use Carbon\Carbon;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\AddSubBrandRequest;
use App\Http\Requests\Brand\UpdateSubBrandRequest;

class SubBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::where('parent_brand_id',auth('brand')->user()->id)->get();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "brand", 'name' => "Dashboard"], ['name' => "Sub Brands"],
        ];

        $addNewBtn = "brand.sub-brand.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend-brand.sub-brands.list', compact('brands', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
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
            ['link' => "brand", 'name' => "Dashboard"], ['link' => "brand/sub-brand", 'name' => "Sub Brands"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend-brand.sub-brands.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubBrandRequest $request)
    {
        try {
            $subBrand = new Brand();

            $subBrand->parent_brand_id = auth('brand')->user()->id;
            $subBrand->image = $request->hasFile('image') ? uploadFile('brand', $request->file('image')) : null;
            $subBrand->header = $request->hasFile('header') ? uploadFile('brand', $request->file('header')) : null;
            $subBrand->is_active = ($request->has('is_active')) ? true : false;
            $subBrand->status = BrandType::Normal;
            $subBrand->account_verified_at = Carbon::now();
            $subBrand->save();

            foreach ($this->lang as $lang) {
                $subBrand->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $subBrand->save();
            }

            return redirect(route('brand.sub-brand.show', $subBrand))->with('success', __('system-messages.add'));
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
    public function show(Brand $subBrand)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "brand", 'name' => "Dashboard"], ['link' => "brand/sub-brand", 'name' => "Sub Brands"], ['name' => "Update"]
        ];

        return view('backend-brand.sub-brands.show', compact(['subBrand', 'langs', 'breadcrumbs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubBrandRequest $request, Brand $subBrand)
    {
        try {

            $subBrand->parent_brand_id = auth('brand')->user()->id;
            $subBrand->image = $request->hasFile('image') ? uploadFile('brand', $request->file('image'), $subBrand->image) : $subBrand->image;
            $subBrand->header = $request->hasFile('header') ? uploadFile('brand', $request->file('header'), $subBrand->header) : $subBrand->header;
            $subBrand->is_active = ($request->has('is_active')) ? true : false;
            $subBrand->status = BrandType::Normal;
            $subBrand->save();

            foreach ($this->lang as $lang) {
                $subBrand->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $subBrand->save();
            }

            return redirect(route('brand.sub-brand.show', $subBrand))->with('success', __('system-messages.update'));
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
    public function destroy(Brand $subBrand)
    {
        $subBrand->delete();
        return redirect(route('brand.sub-brand.index'))->with('success', __('system-messages.delete'));
    }
}
