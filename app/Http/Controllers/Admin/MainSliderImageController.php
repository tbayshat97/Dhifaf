<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddMainSliderImageRequest;
use App\Http\Requests\Admin\UpdateMainSliderImageRequest;
use App\Models\MainSliderImage;

class MainSliderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainSliderImage = MainSliderImage::all();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "MainSliderImages"],
        ];

        $addNewBtn = "admin.main-slider-image.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.mainSliderImages.list', compact('mainSliderImage', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/main-slider-image", 'name' => "MainSliderImages"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend.mainSliderImages.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddMainSliderImageRequest $request)
    {
        try {
            $mainSliderImage = new MainSliderImage();
            $mainSliderImage->main_slider_id = 1;
            $mainSliderImage->image = $request->hasFile('image') ? uploadFile('mainSliderImage', $request->file('image')) : null;
            $mainSliderImage->save();


            return redirect(route('admin.main-slider-image.show', $mainSliderImage))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainSliderImage  $mainSliderImage
     * @return \Illuminate\Http\Response
     */
    public function show(MainSliderImage $mainSliderImage)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/main-slider-image", 'name' => "MainSliderImages"], ['name' => "Update"]
        ];


        return view('backend.mainSliderImages.show', compact(['mainSliderImage', 'langs', 'breadcrumbs']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainSliderImage  $mainSliderImage
     * @return \Illuminate\Http\Response
     */
    public function edit(MainSliderImage $mainSliderImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainSliderImage  $mainSliderImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMainSliderImageRequest $request, MainSliderImage $mainSliderImage)
    {
        try {
            $mainSliderImage->image = $request->hasFile('image') ? uploadFile('mainSliderImage', $request->file('image'), $mainSliderImage->image) : $mainSliderImage->image;
            $mainSliderImage->save();

            return redirect(route('admin.main-slider-image.show', $mainSliderImage))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainSliderImage  $mainSliderImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainSliderImage $mainSliderImage)
    {
        $mainSliderImage->delete();
        return redirect(route('admin.main-slider-image.index'))->with('success', __('system-messages.delete'));
    }
}
