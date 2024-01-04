<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ApiResponser;

class SettingController extends Controller
{
    use ApiResponser;

    public function freeDelivery()
    {
        $setting = Setting::where('option_key', 'free_delivery_over')->first();

        $result = [
            'value' => $setting->option_value
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function dollarToIraqi()
    {
        $setting = Setting::where('option_key', 'dollar_to_iraqi')->first();

        $result = [
            'value' => $setting->option_value
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }
}
