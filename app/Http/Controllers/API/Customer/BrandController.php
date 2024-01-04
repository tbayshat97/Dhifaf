<?php

namespace App\Http\Controllers\API\Customer;

use App\Enums\BrandType;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\LuxuryBrandCollection;
use App\Http\Resources\LuxuryBrand as ResourcesLuxuryBrand;
use App\Models\Brand;
use App\Models\BrandTranslation;
use App\Traits\ApiResponser;

class BrandController extends Controller
{
    use ApiResponser;

    public function luxury()
    {
        $brands = Brand::where('status', BrandType::Luxury)
            ->whereNull('parent_brand_id')
            ->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new BrandCollection($brands));
    }

    public function showLuxury(Brand $brand)
    {
        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesLuxuryBrand($brand));
    }

    public function showLuxuryWhereSlug($slug)
    {
        $brand = BrandTranslation::where('slug', $slug)->first();
        $brand = $brand->brand;

        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesLuxuryBrand($brand));
    }

    public function normal()
    {
        $brands = Brand::where('status', BrandType::Normal)
            ->whereNull('parent_brand_id')
            ->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new BrandCollection($brands));
    }
}
