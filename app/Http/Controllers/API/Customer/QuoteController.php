<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddQouteRequest;
use App\Models\Quote;
use App\Traits\ApiResponser;

class QuoteController extends Controller
{
    use ApiResponser;

    public function store(AddQouteRequest $request)
    {
        $quote = new Quote();
        $quote->name = $request->name;
        $quote->email = $request->email;
        $quote->message = $request->message;
        $quote->save();

        return $this->successResponse(200, trans('api.public.done'), 200, []);
    }
}
