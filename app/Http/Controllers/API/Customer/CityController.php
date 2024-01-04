<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;
use App\Models\City;
use App\Traits\ApiResponser;

class CityController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $cities = City::all();
        return $this->successResponse(200, trans('api.public.done'), 200, new CityCollection($cities));
    }
}
