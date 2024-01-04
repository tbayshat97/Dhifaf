<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebsitePageCollection;
use App\Models\WebsitePage;
use App\Traits\ApiResponser;

class WebsitePageController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $websitePages = WebsitePage::all();
        return $this->successResponse(200, trans('api.public.done'), 200, new WebsitePageCollection($websitePages));
    }
}
