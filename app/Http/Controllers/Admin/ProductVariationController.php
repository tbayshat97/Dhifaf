<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCombination;
use App\Models\ProductVariation;
use App\Models\ProductVariationItem;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Request $request)
    {
        $product->variations()->delete();
        $product->combinations()->delete();

        foreach ($request['attributes'] as $attribute) {
            $productVariation = new ProductVariation();
            $productVariation->product_id = $product->id;
            $productVariation->save();

            if (!empty($productVariation)) {
                $productVariation->translateOrNew('ar')->name = trim($attribute['attributes_ar']);
                $productVariation->translateOrNew('en')->name = trim($attribute['attributes_en']);
            }

            $productVariation->save();

            foreach ($attribute['inner-list'] as $item) {
                $productVariationItem = new ProductVariationItem();
                $productVariationItem->pv_id = $productVariation->id;
                $productVariationItem->save();

                if (!empty($productVariationItem)) {
                    $productVariationItem->translateOrNew('ar')->name = trim($item['attributes_item_ar']);
                    $productVariationItem->translateOrNew('en')->name = trim($item['attributes_item_en']);
                }

                $productVariationItem->save();
            }
        }

        $product_combinations = [];

        foreach ($product->variations as $attribute) {
            $items = [];
            foreach ($attribute->items as $value) {
                $items[] = $value->id;
            }

            $product_combinations[] = $items;
        }

        $combinations = getCombinations($product_combinations);

        foreach ($combinations as $singleCombination) {
            $combinationName = [];
            foreach ($this->lang as $lang) {
                $combinationName[$lang['code']] = implode(' - ', array_map(function ($id) use ($lang) {
                    $productVariationItem = ProductVariationItem::find($id);
                    return $productVariationItem->translateOrDefault($lang['code'])->name;
                }, $singleCombination));
            }

            $productCombination  = new ProductCombination();
            $productCombination->product_id  =  $product->id;
            $productCombination->combination_id = json_encode($singleCombination);

            $productCombination->qty = rand(1, 6);
            $productCombination->price =  2;
            $productCombination->save();

            foreach ($this->lang as $lang) {
                $productCombination->translateOrNew($lang['code'])->combination = $combinationName[$lang['code']];
            }

            $productCombination->save();
        }

        return redirect(route('admin.product-combination.index', $product->id))->with('success', __('system-messages.add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['link' => "admin/product", 'name' => __('admin-content.products')], ['name' => 'Variants']
        ];

        $pageConfigs = ['pageHeader' => true];

        $variants = [];

        foreach ($product->variations as $key => $variation) {
            $inner_array = [];
            foreach ($variation->items as $innerKey => $item) {
                $inner_array[] = [
                    'attributes_item_en' => $item->translateOrDefault('en')->name,
                    'attributes_item_ar' => $item->translateOrDefault('ar')->name,
                ];
            }

            $variants[] = [
                'attributes_en' => $variation->translateOrDefault('en')->name,
                'attributes_ar' => $variation->translateOrDefault('ar')->name,
                'inner-list' => $inner_array,
            ];
        }

        return view('backend.products.variation.show', compact(['langs', 'product', 'breadcrumbs', 'pageConfigs', 'variants']));
    }
}
