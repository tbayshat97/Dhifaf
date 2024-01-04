<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\GovernorateCollection;
use App\Models\Governorate;
use App\Traits\ApiResponser;

class GovernorateController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $governorates = Governorate::all();
        return $this->successResponse(200, trans('api.public.done'), 200, new GovernorateCollection($governorates));
    }
}
