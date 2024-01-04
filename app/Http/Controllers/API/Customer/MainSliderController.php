<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainSliderCollection;
use App\Http\Resources\WebsiteSliderCollection;
use App\Models\MainSlider;
use App\Models\WebsiteSlider;
use App\Traits\ApiResponser;

class MainSliderController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $mainSliderImages = MainSlider::all();

        return $this->successResponse(200, trans('api.public.done'), 200, new MainSliderCollection($mainSliderImages));
    }

    public function websiteSliderlist()
    {
        $images = WebsiteSlider::all();

        return $this->successResponse(200, trans('api.public.done'), 200, new WebsiteSliderCollection($images));
    }
}
