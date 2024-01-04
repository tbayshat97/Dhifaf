<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerCollection;
use App\Models\Banner;
use App\Traits\ApiResponser;

class BannerController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $banners = Banner::get();

        return $this->successResponse(200, trans('api.public.done'), 200, new BannerCollection($banners));
    }
}
