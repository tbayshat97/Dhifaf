<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Colors"],
        ];

        $addNewBtn = "admin.color.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.colors.list', compact('colors', 'breadcrumbs', 'addNewBtn', 'pageConfigs', 'langs'));
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
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Colors"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.colors.add', compact('breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $color = new Color();
            $color->code = $request->code;
            $color->save();

            foreach ($this->lang as $lang) {
                $color->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
            }

            $color->save();

            return redirect(route('admin.color.show', $color))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        $langs = $this->lang;
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/color", 'name' => "Colors"], ['name' => "Update"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.colors.show', compact('color', 'breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        try {
            $color->code = $request->code;
            $color->save();

            foreach ($this->lang as $lang) {
                $color->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
            }

            $color->save();

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect(route('admin.color.index'))->with('success', __('system-messages.delete'));
    }
}
