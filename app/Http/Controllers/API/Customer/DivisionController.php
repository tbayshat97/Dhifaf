<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Division as ResourcesDivision;
use App\Http\Resources\DivisionCollection;
use App\Models\Division;
use App\Models\Product;
use App\Models\DivisionTranslation;
use App\Traits\ApiResponser;
use App\Enums\ProductStatus;

class DivisionController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $divisions = Division::orderBy('priority', 'asc')->take(6)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new DivisionCollection($divisions));
    }

    public function categories(Division $division)
    {
        $result = [
            'division' => new ResourcesDivision($division),
            'categories' => new CategoryCollection($division->categories())
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function divisionWhereSlug($slug)
    {
        $division = DivisionTranslation::where('slug', $slug)->first();
        $division = $division->division;
        $products = Product::where('division_id', $division->id)->where('is_featured', true)->where('status', ProductStatus::Published)->get();

        $result = [
            'division' => new ResourcesDivision($division),
            'categories' => new CategoryCollection($division->categories()),
            'products' => new ProductCollection($products)
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }
}
