<?php

use App\Enums\BrandType;
use App\Models\Division;
use App\Models\Product;
use App\Models\ProductCombination;
use App\Models\ProductTranslation;
use App\Models\ProductVariation;
use App\Models\ProductVariationItem;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductTranslation::class, 30)->create();

        $products = Product::all();

        $langs = [
            ['name' => 'english', 'code' => 'en'],
            ['name' => 'arabic', 'code' => 'ar'],
        ];

        foreach ($products as $product) {
            $brand = Brand::inRandomOrder()->limit(1)->first();
            $product->brand_id = $brand->id;

            $courseRate = starRatingsCalculator(Product::class, $product->id);
            $product->rate = $courseRate['total'];

            $categories = Category::inRandomOrder()->limit(1)->pluck('id')->toArray();

            $product->categories = json_encode($categories);

            // $product_combinations = [];

            // $langs = [
            //     ['name' => 'english', 'code' => 'en'],
            //     ['name' => 'arabic', 'code' => 'ar'],
            // ];

            // $variations = [['ar' => 'اللون', 'en' => 'color'], ['ar' => 'الحجم', 'en' => 'size']];

            // foreach ($variations as $key => $singleItem) {
            //     $productVariation = new ProductVariation();
            //     $productVariation->product_id = $product->id;
            //     $productVariation->save();

            //     if (!empty($productVariation)) {
            //         foreach ($langs as $lang) {
            //             $productVariation->translateOrNew($lang['code'])->name = trim($singleItem[$lang['code']]);
            //             $productVariation->save();
            //         }
            //     }

            //     if ($key === 0) {
            //         $colorVariationsItems = [
            //             ['en' => 'Black', 'ar' => 'اسود'],
            //             ['en' => 'Red', 'ar' => 'احمر'],
            //             ['en' => 'Purple', 'ar' => 'نفسجي'],
            //             ['en' => 'Yellow', 'ar' => 'اصفر'],
            //             ['en' => 'Blue', 'ar' => 'ازرق'],
            //         ];

            //         foreach ($colorVariationsItems as $variationsItem) {
            //             $productVariationItem = new ProductVariationItem();
            //             $productVariationItem->pv_id = $productVariation->id;
            //             $productVariationItem->save();

            //             if (!empty($productVariationItem)) {
            //                 foreach ($langs as $lang) {
            //                     $productVariationItem->translateOrNew($lang['code'])->name = trim($variationsItem[$lang['code']]);
            //                     $productVariationItem->save();
            //                 }
            //             }
            //         }
            //     }

            //     if ($key === 1) {
            //         $sizeVariationsItems = [
            //             ['ar' => 'XXXS', 'en' => 'XXXS'],
            //             ['ar' => 'XXS', 'en' => 'XXS'],
            //             ['ar' => 'XS', 'en' => 'XS'],
            //             ['ar' => 'S', 'en' => 'S',],
            //             ['ar' => 'M', 'en' => 'M',],
            //             ['ar' => 'L', 'en' => 'L',],
            //             ['ar' => 'XL', 'en' => 'XL',],
            //             ['ar' => 'XXL', 'en' => 'XXL',],
            //             ['ar' => 'XXXL', 'en' => 'XXXL'],
            //         ];

            //         foreach ($sizeVariationsItems as $variationsItem) {
            //             $productVariationItem = new ProductVariationItem();
            //             $productVariationItem->pv_id  = $productVariation->id;
            //             $productVariationItem->save();

            //             if (!empty($productVariationItem)) {
            //                 foreach ($langs as $lang) {
            //                     $productVariationItem->translateOrNew($lang['code'])->name = trim($variationsItem[$lang['code']]);
            //                     $productVariationItem->save();
            //                 }
            //             }
            //         }
            //     }
            // }

            // $product->save();

            // foreach ($product->variations as $attribute) {
            //     $tmp = [];
            //     foreach ($attribute->items as $value) {
            //         $tmp[] = $value->id;
            //     }

            //     $product_combinations[] = $tmp;
            // }

            // $combinations = getCombinations($product_combinations);

            // foreach ($combinations as $singleCombination) {
            //     $combinationName = [];
            //     foreach ($langs as $lang) {
            //         $combinationName[$lang['code']] = implode(' - ', array_map(function ($id) use ($lang) {
            //             $productVariationItem = ProductVariationItem::find($id);
            //             return $productVariationItem->translateOrDefault($lang['code'])->name;
            //         }, $singleCombination));
            //     }

            //     $productCombination  = new ProductCombination();
            //     $productCombination->product_id  =  $product->id;
            //     $productCombination->combination_id = json_encode($singleCombination);

            //     $productCombination->qty = rand(1, 6);
            //     $productCombination->price =  2;
            //     $productCombination->save();

            //     foreach ($langs as $lang) {
            //         $productCombination->translateOrNew($lang['code'])->combination = $combinationName[$lang['code']];
            //     }

            //     $productCombination->save();
            // }

            $product->save();
        }
    }
}
