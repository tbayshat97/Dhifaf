<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddGovernorateRequest;
use App\Http\Requests\Admin\UpdateGovernorateRequest;
use App\Models\Governorate;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governorates = Governorate::all();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Governorates"],
        ];

        $addNewBtn = "admin.governorate.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.governorates.list', compact('governorates', 'breadcrumbs', 'addNewBtn', 'pageConfigs', 'langs'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Governorates"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.governorates.add', compact('breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddGovernorateRequest $request)
    {
        try {
            $governorate = new Governorate();
            foreach ($this->lang as $lang) {
                $governorate->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $governorate->country_id = 1;
                $governorate->save();
            }
            return redirect(route('admin.governorate.show', $governorate))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Governorate  $governorate
     * @return \Illuminate\Http\Response
     */
    public function show(Governorate $governorate)
    {
        $langs = $this->lang;
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/governorate", 'name' => "Governorates"], ['name' => "Update"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.governorates.show', compact('governorate', 'breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Governorate  $governorate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGovernorateRequest $request, Governorate $governorate)
    {
        try {
            foreach ($this->lang as $lang) {
                $governorate->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $governorate->save();
            }
            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Governorate  $governorate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        return redirect(route('admin.governorate.index'))->with('success', __('system-messages.delete'));
    }
}
