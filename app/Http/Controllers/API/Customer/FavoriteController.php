<?php

namespace App\Http\Controllers\API\Customer;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Favorite as ResourcesFavorite;
use App\Http\Resources\ProductCollection;
use App\Models\Favorite;
use App\Models\Product;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $customer = auth()->user();

        $product_ids = $customer->favourites()->pluck('product_id');

        $products = Product::whereIn('id', $product_ids)->where('status', ProductStatus::Published)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $is_exists = Favorite::where([
            ['customer_id', '=', auth()->user()->id],
            ['product_id', '=', $request->product_id],
        ]);

        if ($is_exists->count() > 0) {
            return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesFavorite($is_exists->first()));
        }

        $favorite = new Favorite();
        $favorite->customer_id = auth()->user()->id;
        $favorite->product_id = $request->product_id;
        $favorite->save();

        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesFavorite($favorite));
    }

    public function destroy(Product $product)
    {
        $singleItem = Favorite::where('customer_id', auth()->user()->id)->where('product_id', $product->id)->first();

        if ($singleItem) {
            $singleItem->delete();
        }
        return $this->successResponse(200, trans('api.public.done'), 200, []);
    }
}
