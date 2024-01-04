<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddAreaRequest;
use App\Http\Requests\Admin\UpdateAreaRequest;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Areas"],
        ];

        $addNewBtn = "admin.area.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.areas.list', compact('areas', 'breadcrumbs', 'addNewBtn', 'pageConfigs', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Areas"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.areas.add', compact('cities', 'breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddAreaRequest $request)
    {
        try {
            $area = new Area();
            $area->city_id = $request->city_id;
            $area->delivery_fees = $request->delivery_fees;

            foreach ($this->lang as $lang) {
                $area->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $area->save();
            }
            return redirect(route('admin.area.show', $area))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        // $countries = Country::all();
        $cities = City::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });
        $langs = $this->lang;
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/city", 'name' => "Cities"], ['name' => "Update"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.areas.show', compact('area', 'cities', 'breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        try {
            $area->city_id  = $request->city_id;
            $area->delivery_fees = $request->delivery_fees;

            foreach ($this->lang as $lang) {
                $area->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $area->save();
            }
            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect(route('admin.area.index'))->with('success', __('system-messages.delete'));
    }

    public function getAjaxCity(Request $request)
    {
        $cities = City::where('country_id', (int) $request->get('id'))->get();

        $output = [];

        foreach ($cities as $city) {
            $output[$city->id] = $city->translateOrDefault()->name;
        }

        return $output;
    }
}
