<?php

namespace App\Http\Controllers\brand;
use App\Models\BrandSlider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\AddSliderRequest;
use App\Http\Requests\Brand\UpdateSliderRequest;
use Illuminate\Support\Facades\Auth;

class BrandSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = BrandSlider::where('brand_id',auth('brand')->user()->id)->get();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "brand", 'name' =>'Dashboard'], ['name' => 'Sliders'],
        ];

        $addNewBtn = "brand.brand-slider.create";

        $pageConfigs = ['pageHeader' => true];
        return view('backend-brand.sliders.list', compact('slider', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
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
            ['link' => "brand", 'name' => "Dashboard"], ['link' => "brand/brand-slider", 'name' => "Sliders"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend-brand.sliders.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSliderRequest $request)
    {
        try {
            $brandSlider = new BrandSlider();
            $brandSlider->brand_id = auth('brand')->user()->id;
            $brandSlider->image = $request->hasFile('image') ? uploadFile('brand-slider', $request->file('image')) : null;
            $brandSlider->logo = $request->hasFile('logo') ? uploadFile('brand-slider', $request->file('logo'), $brandSlider->logo) : $brandSlider->logo;
            $brandSlider->btn_link = trim($request->get('btn_link'));

            $brandSlider->save();

            foreach ($this->lang as $lang) {
                $brandSlider->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $brandSlider->translateOrNew($lang['code'])->content = trim($request->get('content_' . $lang['code']));
                $brandSlider->translateOrNew($lang['code'])->btn_text = trim($request->get('btn_text_' . $lang['code']));
                $brandSlider->save();
            }

            return redirect(route('brand.brand-slider.show', $brandSlider))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandSlider  $brandSlider
     * @return \Illuminate\Http\Response
     */
    public function show(BrandSlider $brandSlider)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "brand", 'name' => "Dashboard"], ['link' => "brand/brand-slider", 'name' => "Sliders"], ['name' => "Update"]
        ];

        return view('backend-brand.sliders.show', compact(['brandSlider', 'langs', 'breadcrumbs']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandSlider  $brandSlider
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandSlider $brandSlider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrandSlider  $brandSlider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, BrandSlider $brandSlider)
    {
        try {

            $brandSlider->image = $request->hasFile('image') ? uploadFile('brand-slider', $request->file('image'), $brandSlider->image) : $brandSlider->image;
            $brandSlider->logo = $request->hasFile('logo') ? uploadFile('brand-slider', $request->file('logo'), $brandSlider->logo) : $brandSlider->logo;
            $brandSlider->btn_link = trim($request->get('btn_link'));
            $brandSlider->save();

            foreach ($this->lang as $lang) {
                $brandSlider->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $brandSlider->translateOrNew($lang['code'])->content = trim($request->get('content_' . $lang['code']));
                $brandSlider->translateOrNew($lang['code'])->btn_text = trim($request->get('btn_text_' . $lang['code']));
                $brandSlider->save();
            }

            return redirect(route('brand.brand-slider.show', $brandSlider))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandSlider  $brandSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandSlider $brandSlider)
    {
        $brandSlider->delete();
        return redirect(route('brand.brand-slider.index'))->with('success', __('system-messages.delete'));
    }
}
