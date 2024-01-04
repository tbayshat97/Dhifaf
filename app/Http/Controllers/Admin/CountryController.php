<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCountryRequest;
use App\Http\Requests\Admin\UpdateCountryRequest;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = Country::all();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Countries"],
        ];

        $addNewBtn = "admin.country.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.countries.list', compact('country', 'breadcrumbs', 'addNewBtn', 'pageConfigs', 'langs'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Countries"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.countries.add', compact('breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCountryRequest $request)
    {
        try {
            $country = new Country();
            $country->iso = $request->iso;
            $country->code = trim($request->code);
            foreach ($this->lang as $lang) {
                $country->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $country->save();
            }
            return redirect(route('admin.country.show', $country))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        $langs = $this->lang;
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/country", 'name' => "Countries"], ['name' => "Update"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.countries.show', compact('country', 'breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        try {
            $country->iso = $request->iso;
            $country->code = trim($request->code);
            foreach ($this->lang as $lang) {
                $country->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $country->save();
            }
            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect(route('admin.country.index'))->with('success', __('system-messages.delete'));
    }
}
