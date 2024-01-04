<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddBannerRequest;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => 'Dashboard'], ['name' => 'Banners'],
        ];

        $addNewBtn = "admin.banner.create";

        $pageConfigs = ['pageHeader' => true];
        return view('backend.banners.list', compact('banners', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/banner", 'name' => "Banners"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend.banners.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
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
            $banner = new Banner();

            $banner->image = $request->hasFile('image') ? uploadFile('banner', $request->file('image')) : null;
            $banner->cta = $request->cta;

            $banner->save();

            foreach ($this->lang as $lang) {
                $banner->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $banner->save();
            }

            return redirect(route('admin.banner.show', $banner))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/banner", 'name' => "Banners"], ['name' => "Update"]
        ];

        return view('backend.banners.show', compact(['banner', 'langs', 'breadcrumbs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(AddBannerRequest $request, Banner $banner)
    {
        try {
            $banner->image = $request->hasFile('image') ? uploadFile('banner', $request->file('image'), $banner->image) : $banner->image;
            $banner->cta = $request->cta;
            $banner->save();

            foreach ($this->lang as $lang) {
                $banner->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $banner->save();
            }

            return redirect(route('admin.banner.show', $banner))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect(route('admin.banner.index'))->with('success', __('system-messages.delete'));
    }
}
