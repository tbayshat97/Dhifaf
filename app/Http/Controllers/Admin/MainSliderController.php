<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddMainSliderRequest;
use App\Models\MainSlider;
use App\Http\Requests\Admin\UpdateMainSliderRequest;

class MainSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "MainSlider"],
        ];

        $pageConfigs = ['pageHeader' => true];

        $addNewBtn = "admin.main-slider.create";


        $mainSlider = MainSlider::all();

        return view('backend.main-sliders.list', compact('mainSlider', 'breadcrumbs', 'addNewBtn'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/main-slider", 'name' => "MainSlider"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.main-sliders.add', compact('langs', 'breadcrumbs', 'pageConfigs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddMainSliderRequest $request)
    {
        try {
            $mainSlider = new MainSlider();
            $mainSlider->image = $request->hasFile('image') ? uploadFile('mainSlider', $request->file('image')) : null;
            $mainSlider->btn_link = trim($request->get('btn_link'));
            foreach ($this->lang as $lang) {
                $mainSlider->translateOrNew($lang['code'])->line_one = trim($request->get('line_one_' . $lang['code']));
                $mainSlider->translateOrNew($lang['code'])->line_two = trim($request->get('line_two_' . $lang['code']));
                $mainSlider->translateOrNew($lang['code'])->line_three = trim($request->get('line_three_' . $lang['code']));
                $mainSlider->translateOrNew($lang['code'])->line_four = trim($request->get('line_four_' . $lang['code']));
                $mainSlider->translateOrNew($lang['code'])->btn_text = trim($request->get('btn_text_' . $lang['code']));
                $mainSlider->save();
            }

            return redirect(route('admin.main-slider.show', $mainSlider->id))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainSlider  $appSlider
     * @return \Illuminate\Http\Response
     */
    public function show(MainSlider $mainSlider)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/app-slider", 'name' => "Main Slider"], ['name' => "Update"]
        ];
        $pageConfigs = ['pageHeader' => true];

        return view('backend.main-sliders.show', compact(['mainSlider', 'langs', 'breadcrumbs', 'pageConfigs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainSlider  $appSlider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMainSliderRequest $request, MainSlider $mainSlider)
    {
        try {
            $mainSlider->image = $request->hasFile('image') ? uploadFile('mainSlider', $request->file('image')) : $mainSlider->image;
            $mainSlider->btn_link = trim($request->get('btn_link'));

            foreach ($this->lang as $lang) {
                $mainSlider->translateOrNew($lang['code'])->line_one = trim($request->get('line_one_' . $lang['code']));
                $mainSlider->translateOrNew($lang['code'])->line_two = trim($request->get('line_two_' . $lang['code']));
                $mainSlider->translateOrNew($lang['code'])->line_three = trim($request->get('line_three_' . $lang['code']));
                $mainSlider->translateOrNew($lang['code'])->line_four = trim($request->get('line_four_' . $lang['code']));
                $mainSlider->translateOrNew($lang['code'])->btn_text = trim($request->get('btn_text_' . $lang['code']));
                $mainSlider->save();
            }

            return redirect(route('admin.main-slider.show', $mainSlider->id))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainSlider  $mainSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainSlider $mainSlider)
    {
        $mainSlider->delete();
        return redirect(route('admin.main-slider.index'))->with('success', __('system-messages.delete'));
    }
}
