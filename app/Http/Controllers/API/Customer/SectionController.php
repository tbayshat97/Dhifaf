<?php

namespace App\Http\Controllers\API\Customer;

use App\Models\Section;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionCollection;
use App\Http\Resources\Section as ResourcesSection;
use App\Http\Requests\Customer\SectionRequest;

class SectionController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $sections = Section::all();

        return $this->successResponse(200, trans('api.public.done'), 200, new SectionCollection($sections));
    }

    public function show(SectionRequest $request)
    {
        $section = Section::where('key', intval($request->key))->first();

        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesSection($section));
    }
}
