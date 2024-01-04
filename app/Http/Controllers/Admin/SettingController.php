<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show(Request $request)
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Settings"],
        ];

        $pageConfigs = ['pageHeader' => true];

        $freeDeliveryOver = Setting::where('option_key', 'free_delivery_over')->first();

        $minimumQty = Setting::where('option_key', 'minimum_qty')->first();

        $dollarToIraqi = Setting::where('option_key', 'dollar_to_iraqi')->first();

        return view('backend.settings.show', compact('dollarToIraqi', 'minimumQty', 'freeDeliveryOver', 'breadcrumbs', 'pageConfigs'));
    }

    public function save(Request $request)
    {
        $rules = [
            'minimum_qty' => 'required|numeric',
            'free_delivery_over' => 'required|numeric',
            'dollar_to_iraqi' => 'required|numeric',
        ];

        $request->validate($rules);

        try {
            Setting::where('option_key', 'free_delivery_over')->update([
                'option_value' => $request->free_delivery_over,
            ]);

            Setting::where('option_key', 'minimum_qty')->update([
                'option_value' => $request->minimum_qty,
            ]);

            Setting::where('option_key', 'dollar_to_iraqi')->update([
                'option_value' => $request->dollar_to_iraqi,
            ]);

            return redirect(route('admin.setting'))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
