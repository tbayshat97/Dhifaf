<?php

namespace App\Http\Controllers\API\Customer;

use App\Models\Faq;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\FaqCollection;

class FaqController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $faqs = Faq::all();

        return $this->successResponse(200, trans('api.public.done'), 200, new FaqCollection($faqs));
    }
}
