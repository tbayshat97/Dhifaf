<?php

namespace App\Http\Controllers\brand;

use App\Models\BrandAbout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Http\Requests\Brand\AddBrandAboutRequest;
use App\Http\Requests\Brand\UpdateBrandAboutLinkRequest;
use App\Http\Requests\Brand\UpdateBrandAboutRequest;

class BrandAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_about = BrandAbout::where('brand_id', auth('brand')->user()->id)->first();


        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Brand abouts"],
        ];

        $pageConfigs = ['pageHeader' => true];

        if($brand_about)
        {
            return view('backend-brand.abouts.show', compact('brand_about', 'langs', 'pageConfigs', 'breadcrumbs'));
        }

        return view('backend-brand.abouts.add', compact( 'langs', 'pageConfigs', 'breadcrumbs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBrandAboutRequest $request)
    {
        try {
            $brand_about = new BrandAbout();
            $brand_about->brand_id = auth('brand')->user()->id;
            $brand_about->big_image = $request->hasFile('big_image') ? uploadFile('brand-about', $request->file('big_image'), $brand_about->big_image) : $brand_about->big_image;
            $brand_about->small_image = $request->hasFile('small_image') ? uploadFile('brand-about', $request->file('small_image'), $brand_about->small_image) : $brand_about->small_image;
            $brand_about->save();

            foreach ($this->lang as $lang) {
                $brand_about->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $brand_about->translateOrNew($lang['code'])->description = trim($request->get('description_' . $lang['code']));
                $brand_about->save();
            }

            return redirect(route('brand.brand-about.index'))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandAbout  $brandAbout
     * @return \Illuminate\Http\Response
     */
    public function show(BrandAbout $brandAbout)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandAbout  $brandAbout
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandAbout $brandAbout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrandAbout  $brandAbout
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandAboutRequest $request, BrandAbout $brand_about)
    {
        try {
            $brand_about->big_image = $request->hasFile('big_image') ? uploadFile('brand-about', $request->file('big_image'), $brand_about->big_image) : $brand_about->big_image;
            $brand_about->small_image = $request->hasFile('small_image') ? uploadFile('brand-about', $request->file('small_image'), $brand_about->small_image) : $brand_about->small_image;
            $brand_about->save();

            foreach ($this->lang as $lang) {
                $brand_about->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $brand_about->translateOrNew($lang['code'])->description = trim($request->get('description_' . $lang['code']));
                $brand_about->save();
            }

            return redirect(route('brand.brand-about.index'))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandAbout  $brandAbout
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandAbout $brandAbout)
    {
        //
    }
}
