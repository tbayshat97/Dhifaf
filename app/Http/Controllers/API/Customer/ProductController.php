<?php

namespace App\Http\Controllers\API\Customer;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Brand as ResourcesBrand;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\Category as ResourcesCategory;
use App\Http\Resources\SubCategory as ResourcesSubCategory;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\Size as ResourcesSize;
use App\Http\Resources\Color as ResourcesColor;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductPaginateCollection;
use App\Models\Brand;
use App\Models\BrandTranslation;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\CategoryTranslation;
use App\Models\Division;
use App\Models\DivisionTranslation;
use App\Models\CrossSaleProduct;
use App\Models\Product;
use App\Models\UpSaleProduct;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $products = Product::where('status', ProductStatus::Published)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function showCategoryProduct(Category $category)
    {
        $products = Product::where('status', ProductStatus::Published)->whereJsonContains('categories', [$category->id])->get();

        $result = [
            'category' => new ResourcesCategory($category),
            'products' => new ProductCollection($products)
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function showCategoryProductWhereSlug($slug)
    {
        $category = Category::whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->first();

        $result = [];

        if ($category) {
            $products = Product::where('status', ProductStatus::Published)->whereJsonContains('categories', [$category->id])->paginate(24);
            $result = [
                'category' => new ResourcesCategory($category),
                'products' => new ProductPaginateCollection($products),
            ];
        }

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function showSubCategoryProduct(SubCategory $subCategory)
    {
        $products = Product::where('status', ProductStatus::Published)->whereJsonContains('sub_categories', [$subCategory->id])->get();

        $result = [
            'parent_category' => new ResourcesCategory($subCategory->category),
            'products' => new ProductCollection($products)
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function showSubCategoryProductWhereSlug($slug)
    {
        $subCategory = SubCategory::whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->first();

        $result = [];

        if ($subCategory) {
            $products = Product::where('status', ProductStatus::Published)->whereJsonContains('sub_categories', [$subCategory->id])->paginate(24);

            $result = [
                'parent_category' => new ResourcesCategory($subCategory->category),
                'products' => new ProductCollection($products)
            ];
        }

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function showBrandProduct(Brand $brand)
    {
        $products = Product::where('status', ProductStatus::Published)->where('brand_id', $brand->id)->get();

        $result = [
            'brand' => new ResourcesBrand($brand),
            'products' => new ProductCollection($products)
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function showBrandProductWhereSlug($slug)
    {
        $brand = Brand::whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->first();

        $result = [];

        if ($brand) {
            $products = Product::where('status', ProductStatus::Published)->where('brand_id', $brand->id)->get();

            $result = [
                'brand' => new ResourcesBrand($brand),
                'products' => new ProductCollection($products)
            ];
        }

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function show(Product $product)
    {
        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesProduct($product));
    }

    public function showWhereSlug($slug)
    {
        $product = Product::whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->first();
        return $this->successResponse(200, trans('api.public.done'), 200, $product ? new ResourcesProduct($product) : $product);
    }

    public function featured()
    {
        $products = Product::where('status', ProductStatus::Published)->where('search_appearance', 1)->where('is_featured', true)->limit(25)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function new()
    {
        $products = Product::where('status', ProductStatus::Published)->where('search_appearance', 1)->where('new_arrival', true)->limit(30)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function top()
    {
        $products = Product::where('status', ProductStatus::Published)->where('search_appearance', 1)->where('best_sellers', true)->limit(30)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function hot()
    {
        $products = Product::where('status', ProductStatus::Published)->where('search_appearance', 1)->whereNotNull('sale_price')->limit(30)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function showRelatedProduct(Product $product)
    {
        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($product->related()));
    }

    public function showRelatedProductWhereSlug($slug)
    {
        $product = Product::whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->first();

        return $this->successResponse(200, trans('api.public.done'), 200, $product ?  new ProductCollection($product->related()) : null);
    }

    public function upSaleProduct(Request $request)
    {
        $productsIds = UpSaleProduct::whereIn('product_id', $request->product_id)->whereNotIn('up_sale_id', $request->product_id)->pluck('up_sale_id')->toArray();

        $products = Product::where('status', ProductStatus::Published)->whereIn('id', $productsIds)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function crossSaleProduct(Request $request)
    {
        $productsIds = CrossSaleProduct::whereIn('product_id', $request->product_id)->whereNotIn('cross_sale_id', $request->product_id)->pluck('cross_sale_id')->toArray();
        $products = Product::where('status', ProductStatus::Published)->whereIn('id', $productsIds)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function search(Request $request)
    {
        $searchQuery = Product::query();

        $searchQuery->where('status', ProductStatus::Published);

        if ($request->filled('title')) {
            $searchQuery->whereTranslationLike('title', '%' . $request->title . '%');
        }

        if ($request->filled('brand')) {
            $searchQuery->whereIn('brand_id', [$request->brand]);
        }

        if ($request->filled('category')) {
            $searchQuery->whereJsonContains('categories', array_map(function ($item) {
                return intval($item);
            }, $request->category));
        }

        if ($request->filled('sub_category')) {
            $searchQuery->whereJsonContains('sub_categories', array_map(function ($item) {
                return intval($item);
            }, $request->sub_category));
        }

        if ($request->filled('size')) {
            $searchQuery->where('size_id', $request->size);
        }

        if ($request->filled('color')) {
            $searchQuery->where('color_id', $request->color);
        }

        if ($request->filled('priceFrom') && $request->filled('priceTo')) {
            $searchQuery->whereBetween('price', [$request->priceFrom - 1, $request->priceTo + 1]);
        }

        $products = $searchQuery->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function showAllProductsByParams(Request $request)
    {
        $map=[];
        $searchQuery = Product::query();
        $searchQuery->where('status', ProductStatus::Published)->where('search_appearance', 1);

        if ($request->filled('brand')) {
            $brand = BrandTranslation::where('slug', $request->brand)->first();
            if ($brand) {
                $brand = $brand->brand;
                $searchQuery->where('brand_id', $brand->id);
                $filters = $searchQuery->orderBy('price')->get();
                $data = [];
                $map['brands'] = $filters->map(
                    function ($items) {
                        $data = new ResourcesBrand($items->brand);
                        return  $data;
                    }
                )->unique()->values();
                $map['sub_brands'] = $filters->map(
                    function ($items) {
                        if ($items->sub_brand) {
                            $data = new ResourcesBrand($items->sub_brand);
                            return  $data;
                        }
                    }
                )->unique()->values();
                $map['cateogries'] = $filters->map(
                    function ($items) {
                        if ($items->category()) {
                        $categories = $items->category();
                        $data = new ResourcesCategory($categories);
                        return $data;
                        }
                    }
                )->unique()->values();
                $map['sub_categories'] = $filters->map(
                    function ($items) {
                        if ($items->sub_category()) {
                        $categories = $items->sub_category();
                        $data = new ResourcesSubCategory($categories);
                        return $data;
                        }
                    }
                )->unique()->values();
                $map['sizes'] = $filters->map(
                    function ($items) {
                        if ($items->size) {
                            $size = $items->size;
                            $data = new ResourcesSize($size);
                            return $data;
                        }
                    }
                )->unique()->values();
                $map['colors'] = $filters->map(
                    function ($items) {
                        $data = $items->color;
                        return $data;
                    }
                )->unique()->values();
                $map['max_price'] = $filters->map(
                    function ($items) {
                        $data['max_price'] = $items->price;
                        return $data;
                    }
                )->last();
                $map['min_price'] = $filters->map(
                    function ($items) {
                        $data['min_price'] = $items->price;
                        return $data;
                    }
                )->first();
            }
        }

        if ($request->filled('category')) {
            $category = CategoryTranslation::where('slug', $request->category)->first();
            if ($category) {
                $category = $category->category;
                $searchQuery->whereJsonContains('categories', [$category->id]);
                $filters = $searchQuery->orderBy('price')->get();
                $data = [];
                $map['brands'] = $filters->map(
                    function ($items) {
                        $data = new ResourcesBrand($items->brand);
                        return  $data;
                    }
                )->unique()->values();
                $map['sub_brands'] = $filters->map(
                    function ($items) {
                        if ($items->sub_brand) {
                            $data = new ResourcesBrand($items->sub_brand);
                            return  $data;
                        }
                    }
                )->unique()->values();
                $map['cateogries'] = $filters->map(
                    function ($items) {
                        if ($items->category()) {
                        $categories = $items->category();
                        $data = new ResourcesCategory($categories);
                        return $data;
                        }
                    }
                )->unique()->values();
                $map['sub_categories'] = $filters->map(
                    function ($items) {
                        if ($items->sub_category()) {
                        $categories = $items->sub_category();
                        $data = new ResourcesSubCategory($categories);
                        return $data;
                        }
                    }
                )->unique()->values();
                $map['sizes'] = $filters->map(
                    function ($items) {
                        if ($items->size) {
                            $size = $items->size;
                            $data = new ResourcesSize($size);
                            return $data;
                        }
                    }
                )->unique()->values();
                $map['colors'] = $filters->map(
                    function ($items) {
                        $data = $items->color;
                        return $data;
                    }
                )->unique()->values();
                $map['max_price'] = $filters->map(
                    function ($items) {
                        $data['max_price'] = $items->price;
                        return $data;
                    }
                )->last();
                $map['min_price'] = $filters->map(
                    function ($items) {
                        $data['min_price'] = $items->price;
                        return $data;
                    }
                )->first();
            }
        }
        if($request->filled('subCategory')){
            $subCategory = SubCategory::where('id', (int)$request->subCategory)->first();
            if($subCategory){
                $searchQuery->whereJsonContains('sub_categories', [$subCategory->id]);
                $filters = $searchQuery->orderBy('price')->get();
                $data = [];
                $map['brands'] = $filters->map(
                    function ($items) {
                        $data = new ResourcesBrand($items->brand);
                        return  $data;
                    }
                )->unique()->values();
                $map['sub_brands'] = $filters->map(
                    function ($items) {
                        if ($items->sub_brand) {
                            $data = new ResourcesBrand($items->sub_brand);
                            return  $data;
                        }
                    }
                )->unique()->values();
                $map['cateogries'] = $filters->map(
                    function ($items) {
                        if ($items->category()) {
                        $categories = $items->category();
                        $data = new ResourcesCategory($categories);
                        return $data;
                        }
                    }
                )->unique()->values();
                $map['sub_categories'] = $filters->map(
                    function ($items) {
                        if ($items->sub_category()) {
                        $categories = $items->sub_category();
                        $data = new ResourcesSubCategory($categories);
                        return $data;
                        }
                    }
                )->unique()->values();
                $map['sizes'] = $filters->map(
                    function ($items) {
                        if ($items->size) {
                            $size = $items->size;
                            $data = new ResourcesSize($size);
                            return $data;
                        }
                    }
                )->unique()->values();
                $map['colors'] = $filters->map(
                    function ($items) {
                        $data = $items->color;
                        return $data;
                    }
                )->unique()->values();
                $map['max_price'] = $filters->map(
                    function ($items) {
                        $data['max_price'] = $items->price;
                        return $data;
                    }
                )->last();
                $map['min_price'] = $filters->map(
                    function ($items) {
                        $data['min_price'] = $items->price;
                        return $data;
                    }
                )->first();
            }

        }
        if ($request->filled('division')) {
            $division = DivisionTranslation::where('slug', $request->division)->first();
            if ($division) {
                $division = $division->division;
                $searchQuery->where('division_id', $division->id);
                $filters = $searchQuery->orderBy('price')->get();
                $data = [];
                $map['brands'] = $filters->map(
                    function ($items) {
                        $data = new ResourcesBrand($items->brand);
                        return  $data;
                    }
                )->unique()->values();
                $map['sub_brands'] = $filters->map(
                    function ($items) {
                        if ($items->sub_brand) {
                            $data = new ResourcesBrand($items->sub_brand);
                            return  $data;
                        }
                    }
                )->unique()->values();
                $map['cateogries'] = $filters->map(
                    function ($items) {
                        if ($items->category()) {
                        $categories = $items->category();
                        $data = new ResourcesCategory($categories);
                        return $data;
                        }
                    }
                )->unique()->values();
                $map['sub_categories'] = $filters->map(
                    function ($items) {
                        if ($items->sub_category()) {
                        $categories = $items->sub_category();
                        $data = new ResourcesSubCategory($categories);
                        return $data;
                        }
                    }
                )->unique()->values();
                $map['sizes'] = $filters->map(
                    function ($items) {
                        if ($items->size) {
                            $size = $items->size;
                            $data = new ResourcesSize($size);
                            return $data;
                        }
                    }
                )->unique()->values();
                $map['colors'] = $filters->map(
                    function ($items) {
                        $data = $items->color;
                        return $data;
                    }
                )->unique()->values();
                $map['max_price'] = $filters->map(
                    function ($items) {
                        $data['max_price'] = $items->price;
                        return $data;
                    }
                )->last();
                $map['min_price'] = $filters->map(
                    function ($items) {
                        $data['min_price'] = $items->price;
                        return $data;
                    }
                )->first();
            }
        }

        if ($request->filled('type')) {
            if ($request->type === 'new') {
                $searchQuery->where('new_arrival', true);
            } else if ($request->type === 'hot') {
                $searchQuery->whereNotNull('sale_price');
            } else if ($request->type === 'sets') {
                $category = CategoryTranslation::where('slug', 'gift-set')->first();
                if ($category) {
                    $category = $category->category;
                    $searchQuery->whereJsonContains('categories', [$category->id]);
                }
            }
        }

        if ($request->filled('orderBy')) {
            if ($request->orderBy === 'default') {
                $searchQuery->orderBy('updated_at', 'desc');
            } else if ($request->orderBy === 'featured') {
                $searchQuery->orderBy('is_featured', 'desc');
            } else if ($request->orderBy === 'rating') {
                $searchQuery->orderBy('best_sellers', 'desc');
            } else if ($request->orderBy === 'date') {
                $searchQuery->orderBy('updated_at', 'desc');
            } else {
                $searchQuery->orderBy('updated_at', 'desc');
            }
        }
        if ($request->filled('perPage')) {
            $products = $searchQuery->paginate($request->perPage);
        } else {
            $products = $searchQuery->paginate(24);
        }

        $result = [
            'filtersData' => $map,
            'products' => new ProductPaginateCollection($products)
        ];


        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    public function showDivisionProduct(Division $division)
    {
        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($division->products));
    }

    public function productWhereDivisionSlug($slug)
    {
        $division = Division::whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->first();

        return $this->successResponse(200, trans('api.public.done'), 200, $division ?  new ProductCollection($division->products) : $division);
    }

    public function giftSet()
    {
        $category = Category::whereHas('translations', function ($q) {
            $q->where('slug', 'gift-set');
        })->first();

        $subCategory = SubCategory::whereHas('translations', function ($q) {
            $q->where('slug', 'gift-set');
        })->first();

        $query = Product::query();

        $products = [];

        if ($category) {
            $query->orWhereJsonContains('categories', [$category->id]);
        }

        if ($subCategory) {
            $query->orWhereJsonContains('sub_categories', [$subCategory->id]);
        }

        if ($category || $subCategory) {
            $query->where('status', ProductStatus::Published);
            $products = $query->get();
        }

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }
}
