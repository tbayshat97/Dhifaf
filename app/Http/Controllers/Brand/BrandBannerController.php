<?php

namespace App\Http\Controllers\brand;
use App\Models\BrandBanner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\AddBannerRequest;
use App\Http\Requests\Brand\UpdateBannerRequest;
use Illuminate\Support\Facades\Auth;

class BrandBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brandBanner = BrandBanner::where('brand_id', auth('brand')->user()->id)->first();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "brand", 'name' =>'Dashboard'], ['name' => 'Banners'],
        ];

        // $addNewBtn = "brand.brand-banner.create";

        $pageConfigs = ['pageHeader' => true];
        if($brandBanner)
        {
            return view('backend-brand.banners.list', compact('brandBanner', 'langs', 'pageConfigs', 'breadcrumbs'));
        }

        return view('backend-brand.banners.add', compact( 'langs', 'pageConfigs', 'breadcrumbs'));
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
            ['link' => "brand", 'name' => "Dashboard"], ['link' => "brand/brand-banner", 'name' => "Banners"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend-brand.banners.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBannerRequest $request)
    {
        try {
            $banner = new BrandBanner();
            $banner->brand_id = auth('brand')->user()->id;
            $banner->image = $request->hasFile('image') ? uploadFile('brand-banner', $request->file('image')) : null;
            $banner->save();

            foreach ($this->lang as $lang) {
                $banner->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $banner->save();
            }

            return redirect(route('brand.brand-banner.index'))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandBanner  $brand_Banner
     * @return \Illuminate\Http\Response
     */
    public function show(BrandBanner $brandBanner)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "brand", 'name' => "Dashboard"], ['link' => "brand/brand-banner", 'name' => "Banners"], ['name' => "Update"]
        ];

        return view('backend-brand.banners.list', compact(['brand_Banner', 'langs', 'breadcrumbs']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandBanner  $brand_Banner
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandBanner $brandBanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrandBanner  $brand_Banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        try {
            $brandBanner = BrandBanner::findOrFail($id);
            $brandBanner->image = $request->hasFile('image') ? uploadFile('brand-banner', $request->file('image'), $brandBanner->image) : $brandBanner->image;
            $brandBanner->save();

            foreach ($this->lang as $lang) {
                $brandBanner->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $brandBanner->save();
            }

            return redirect(route('brand.brand-banner.index'))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandBanner  $brandBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandBanner $brandBanner)
    {
        $brandBanner->delete();
        return redirect(route('brand.brand-banner.index'))->with('success', __('system-messages.delete'));
    }
}
