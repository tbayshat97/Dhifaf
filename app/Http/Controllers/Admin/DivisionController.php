<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddDivisionRequest;
use App\Http\Requests\Admin\UpdateDivisionBannerRequest;
use App\Http\Requests\Admin\UpdateDivisionRequest;
use App\Models\Division;
use App\Models\DivisionBanner;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::orderBy('priority', 'asc')->get();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Divisions"],
        ];

        $addNewBtn = "admin.division.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.divisions.list', compact('divisions', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
    }

    public function banner(Division $division)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => $division->translateOrDefault()->name . ' banner'],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.divisions.banner', compact('division', 'langs', 'pageConfigs', 'breadcrumbs'));
    }

    public function bannerStore(Division $division, UpdateDivisionBannerRequest $request)
    {
        try {
            if ($division->banner) {
                $banner = $division->banner;
                $banner->image = $request->hasFile('image') ? uploadFile('division', $request->file('image'), $banner->image) : $banner->image;
                $banner->cta = $request->cta;
                $banner->save();

                foreach ($this->lang as $lang) {
                    $banner->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                    $banner->save();
                }

                $division->save();
            } else {
                $banner = new DivisionBanner();
                $banner->division_id =  $division->id;
                $banner->image = $request->hasFile('image') ? uploadFile('division', $request->file('image'), $banner->image) : null;
                $banner->cta = $request->cta;
                $banner->save();

                foreach ($this->lang as $lang) {
                    $banner->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                    $banner->save();
                }
            }

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
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
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/division", 'name' => "Divisions"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.divisions.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddDivisionRequest $request)
    {
        try {
            $division = new Division();

            $division->image = $request->hasFile('image') ? uploadFile('division', $request->file('image')) : null;
            $division->header = $request->hasFile('header') ? uploadFile('division', $request->file('header')) : null;

            $division->is_active = ($request->has('is_active')) ? true : false;
            $division->save();

            foreach ($this->lang as $lang) {
                $division->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $division->translateOrNew($lang['code'])->description = trim($request->get('description_' . $lang['code']));

                $division->save();
            }

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/division", 'name' => "Divisions"], ['name' => "Update"]
        ];

        return view('backend.divisions.show', compact(['division', 'langs', 'breadcrumbs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDivisionRequest $request, Division $division)
    {
        try {
            $division->image = $request->hasFile('image') ? uploadFile('division', $request->file('image'), $division->image) : $division->image;
            $division->header = $request->hasFile('header') ? uploadFile('division', $request->file('header'), $division->header) : $division->header;

            $division->is_active = ($request->has('is_active')) ? true : false;
            $division->save();

            foreach ($this->lang as $lang) {
                $division->translateOrNew($lang['code'])->slug = null;
                $division->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $division->translateOrNew($lang['code'])->description = trim($request->get('description_' . $lang['code']));
                $division->save();
            }

            return redirect(route('admin.division.show', $division))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        $division->delete();
        return redirect(route('admin.division.index'))->with('success', __('system-messages.delete'));
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
                $division = Division::find($indexes[$i]);
                $division->priority = $i + 1;
                $division->save();
            }
            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
