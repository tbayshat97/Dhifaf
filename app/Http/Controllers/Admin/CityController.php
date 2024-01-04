<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCityRequest;
use App\Http\Requests\Admin\UpdateCityRequest;
use App\Models\City;
use App\Models\Governorate;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Cities"],
        ];

        $addNewBtn = "admin.city.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.cities.list', compact('cities', 'breadcrumbs', 'addNewBtn', 'pageConfigs', 'langs'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Cities"],
        ];

        $governorates = Governorate::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->title];
        });

        $pageConfigs = ['pageHeader' => true];

        return view('backend.cities.add', compact('breadcrumbs', 'pageConfigs', 'langs', 'governorates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCityRequest $request)
    {
        try {
            $city = new City();
            $city->governorate_id = $request->governorate;

            foreach ($this->lang as $lang) {
                $city->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $city->save();
            }

            return redirect(route('admin.city.show', $city))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/city", 'name' => "Cities"], ['name' => "Update"],
        ];

        $governorates = Governorate::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->title];
        });

        $pageConfigs = ['pageHeader' => true];

        return view('backend.cities.show', compact('city', 'breadcrumbs', 'pageConfigs', 'langs', 'governorates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        try {
            $city->governorate_id = $request->governorate;

            foreach ($this->lang as $lang) {
                $city->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $city->save();
            }
            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect(route('admin.city.index'))->with('success', __('system-messages.delete'));
    }
}
