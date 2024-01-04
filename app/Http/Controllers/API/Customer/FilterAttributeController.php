<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ColorCollection;
use App\Http\Resources\SizeCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Traits\ApiResponser;

class FilterAttributeController extends Controller
{
    use ApiResponser;

    public function brandAttribute(Brand $brand)
    {
        $data = [
            'sort' => [
                'asc' => 'Asc',
                'desc' => 'Desc',
            ],
            'categories' => new CategoryCollection($brand->categories()),
            'price_range' => [
                'min' => Product::min('price'),
                'max' => Product::max('price'),
            ],
            'ratings' => [1, 2, 3, 4, 5],
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $data);
    }

    public function searchAttributes()
    {
        $data = [
            'sort' => [
                'asc' => 'Asc',
                'desc' => 'Desc',
            ],
            'brands' => new BrandCollection(Brand::where('is_active', true)->get()),
            'categories' => new CategoryCollection(Category::where('is_active', true)->get()),
            'colors' => new ColorCollection(Color::all()),
            'sizes' => new SizeCollection(Size::all()),
            'price_range' => [
                'min' => Product::min('price'),
                'max' => Product::max('price'),
            ],
            'ratings' => [1, 2, 3, 4, 5],
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $data);
    }
}
