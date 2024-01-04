<?php

namespace App\Http\Controllers\API\Customer;

use App\Models\Section;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AboutSectionRequest;
use App\Http\Resources\AboutSectionCollection;
use App\Http\Resources\AboutSection as ResourcesSection;
use App\Models\AboutSection;

class AboutSectionController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $sections = AboutSection::all();

        return $this->successResponse(200, trans('api.public.done'), 200, new AboutSectionCollection($sections));
    }

    public function show(AboutSectionRequest $request)
    {
        $section = AboutSection::where('key', intval($request->key))->first();

        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesSection($section));
    }

}
