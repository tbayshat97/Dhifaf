<?php

namespace App\Http\Controllers\API\Customer;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\AreaCollection;
use App\Traits\ApiResponser;

class AreaController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(City $city)
    {
        $areas = $city->areas;
        return $this->successResponse(200, trans('api.public.done'), 200, new AreaCollection($areas));
    }
}
