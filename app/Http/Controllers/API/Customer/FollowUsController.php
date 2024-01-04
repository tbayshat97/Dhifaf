<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\FollowUsCollection;
use App\Models\FollowUs;
use App\Traits\ApiResponser;

class FollowUsController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $links = FollowUs::all();

        return $this->successResponse(200, trans('api.public.done'), 200, new FollowUsCollection($links));
    }
}
