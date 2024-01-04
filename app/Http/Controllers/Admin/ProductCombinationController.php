<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCombination;
use Illuminate\Http\Request;

class ProductCombinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['link' => route('admin.product.show', $product), 'name' => $product->translateOrDefault()->title],
            ['link' => route('admin.product-variation.show', $product), 'name' => 'Variations'],
            ['name' => 'Combinations']
        ];

        $pageConfigs = ['pageHeader' => true];

        $combinations = $product->combinations;

        return view('backend.products.combination.list', compact(['combinations', 'product', 'breadcrumbs', 'pageConfigs']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCombination  $productCombination
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCombination $productCombination)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['link' => route('admin.product.show', $productCombination->product), 'name' => $productCombination->product->translateOrDefault()->title],
            ['link' => route('admin.product-variation.show', $productCombination->product), 'name' => 'Variations'],
            ['link' => route('admin.product-combination.index', $productCombination->product), 'name' => 'Combinations'],
            ['name' => 'Update']
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.products.combination.show', compact(['productCombination', 'langs', 'breadcrumbs', 'pageConfigs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\ProductCombination  $productCombination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCombination $productCombination)
    {
        try {
            $productCombination->sku = $request->sku;
            $productCombination->qty = $request->qty;
            $productCombination->price =  $request->price;
            $productCombination->save();

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCombination  $productCombination
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCombination $productCombination)
    {
        $product = $productCombination->product;
        $productCombination->delete();
        return redirect()->route('admin.product-combination.index', $product)->with('success', __('system-messages.delete'));
    }
}
