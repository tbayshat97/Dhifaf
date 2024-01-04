<?php

namespace App\Http\Controllers\Influencer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InfluencerProduct;
use App\Http\Controllers\Controller;

class InfluencerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Product"], ['name' => "Products"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend-influencer.products.list', compact('products', 'breadcrumbs', 'pageConfigs', 'langs'));
    }

    public function addToInfluencer(Request $request, Product $product)
    {
        try {
            $influencerProduct = new InfluencerProduct();
            $influencerProduct->product_id = $product->id;
            $influencerProduct->influencer_id = auth('influencer')->user()->id;
            $influencerProduct->save();
            return redirect()->back()->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function myProduct()
    {
        $products = Product::whereHas('influencerProducts', function ($q) {
            $q->where('influencer_id', auth('influencer')->user()->id);
        })->get();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "My Product"], ['name' => "My Products"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend-influencer.products.my-products', compact('products', 'breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfluencerProduct  $influencerProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $influencerProduct = InfluencerProduct::where('product_id', $product->id)
            ->where('influencer_id', auth('influencer')->user()->id)->first();

        $influencerProduct->delete();
        return redirect(route('influencer.product.influencer'))->with('success', __('system-messages.delete'));
    }
}
