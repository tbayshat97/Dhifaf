<?php

namespace App\Http\Controllers\API\Customer;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Wishlist as ResourcesWishlist;
use App\Models\Product;
use App\Models\Wishlist;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use ApiResponser;

    public function list(Request $request)
    {
        $customer = auth()->user();
        $product_ids = $customer->wishlists()->pluck('product_id');
        $products = Product::whereIn('id', $product_ids)->where('status', ProductStatus::Published)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new ProductCollection($products));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $is_exists = Wishlist::where([
            ['customer_id', '=', auth()->user()->id],
            ['product_id', '=', $request->product_id],
        ]);

        if ($is_exists->count() > 0) {
            return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesWishlist($is_exists->first()));
        }

        $wishlist = new Wishlist();
        $wishlist->customer_id = auth()->user()->id;
        $wishlist->product_id = $request->product_id;
        $wishlist->save();

        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesWishlist($wishlist));
    }

    public function destroy(Request $request, Product $product)
    {
        $singleItem = Wishlist::where('customer_id', auth()->user()->id)->where('product_id', $product->id)->first();

        if ($singleItem) {
            $singleItem->delete();
        }
        return $this->successResponse(200, trans('api.public.done'), 200, []);
    }
}
