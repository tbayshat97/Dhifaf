<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfluencerCollection;
use App\Http\Resources\Influencer as ResourcesInfluencer;
use App\Models\Influencer;
use App\Models\InfluencerTranslation;
use App\Traits\ApiResponser;

class InfluencerController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $influencers = Influencer::all();

        return $this->successResponse(200, trans('api.public.done'), 200, new InfluencerCollection($influencers));
    }

    public function show(Influencer $influencer)
    {
        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesInfluencer($influencer));
    }

    public function showWhereSlug($slug)
    {
        $influencer = InfluencerTranslation::where('slug', $slug)->first();
        $influencer = $influencer->influencer;
        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesInfluencer($influencer));
    }
}
