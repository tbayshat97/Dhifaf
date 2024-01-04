<?php

namespace App\Http\Controllers\API\Customer;

use App\Enums\BrandType;
use App\Models\Category;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $categories = Category::all();
        return $this->successResponse(200, trans('api.public.done'), 200, new CategoryCollection($categories));
    }

    public function luxury()
    {
        $categories = Category::whereHas('brand', function ($query) {
            $query->where('status', BrandType::Luxury);
        })->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new CategoryCollection($categories));
    }
}
