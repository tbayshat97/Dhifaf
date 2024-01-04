<?php

namespace App\Imports;

use App\Models\CrossSaleProduct;
use App\Models\Product;
use App\Models\RelatedProduct;
use App\Models\UpSaleProduct;
use App\Models\ProductGroup;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public $lang = [
        ['name' => 'english', 'code' => 'en'],
        ['name' => 'arabic', 'code' => 'ar'],
    ];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $product = Product::where('code', $row["code"])->first();

        if ($product) {
            if ($row["categories"]) {
                $categories = array_map(function ($item) {
                    return intval($item);
                }, explode(',', $row["categories"]));
            } else {
                $categories = null;
            }

            if ($row["sub_categories"]) {
                $subCategories = array_map(function ($item) {
                    return intval($item);
                }, explode(',', $row["sub_categories"]));
            } else {
                $subCategories = null;
            }




            $tags = explode(',', $row["tags"]);

            foreach ($this->lang as $lang) {
                $product->translateOrNew($lang['code'])->slug = null;
                $product->translateOrNew($lang['code'])->title = $row['name_' . $lang['code']];
                $product->translateOrNew($lang['code'])->description = $row['description_' . $lang['code']];
                $product->translateOrNew($lang['code'])->ingredients = $row['ingredients_' . $lang['code']];
                $product->translateOrNew($lang['code'])->how_to_use = $row['how_to_use_' . $lang['code']];
            }
            //dd($row["sub_categories"]);
            $product->division_id = $row["division"];
            $product->brand_id = $row["brand"];
            $product->sub_brand_id = $row["sub_brand"];
            $product->categories = $categories ? json_encode($categories) : null;
            $product->sub_categories = $subCategories ? json_encode($subCategories) : null;
            $product->sale_price = $row["sale_price"];
            $product->sale_price_from = $row["start_date_sale_price"];
            $product->sale_price_to = $row["end_date_sale_price"];
            $product->meta_description = $row["meta_description"];
            $product->meta_title = $row["meta_title"];
            $product->new_from = $row["new_from"];
            $product->new_to = $row["new_to"];
            $product->color_id = $row["color"];
            $product->size_id = $row["size"];
            $product->stock_status = intval($row["stock_status"]);
            $product->gender = intval($row["gender"]);
            $product->age_group = intval($row["age_group"]);
            $product->status = intval($row["status"]);
            $product->is_featured = $row["is_featured"] ?? false;
            $product->best_sellers = $row["best_sellers"] ?? false;
            $product->special_offer = $row["special_offer"] ?? false;
            $product->new_arrival = $row["new_arrival"] ?? false;
            $product->tags = json_encode($tags);
            //dd($product);
            $product->save();

            if ($row["group"]) {
                $groupCodes = explode(',', $row["group"]);
                $products = Product::whereIn('code', $groupCodes)->whereDoesntHave('group')->pluck('id')->toArray();
                $product->is_variant = true;
                $product->save();

                if ($product->group) {
                    $group = $product->group;
                    $group->product_id = $product->id;
                    $group->product_group = json_encode($products);
                    $group->save();
                } else {
                    $group = new ProductGroup();
                    $group->product_id = $product->id;
                    $group->product_group = json_encode($products);
                    $group->save();
                }
            }

            $related = explode(',', $row["related_products"]);
            $relatedProducts = Product::whereIn('code', $related)->pluck('id')->toArray();
            RelatedProduct::where('product_id', $product->id)->whereNotIn('related_id', $relatedProducts)->delete();
            $selected = $product->relatedIds();

            foreach ($relatedProducts as $related) {
                if (!in_array($related, $selected)) {
                    $relatedProduct =  new RelatedProduct();
                    $relatedProduct->product_id = $product->id;
                    $relatedProduct->related_id = $related;
                    $relatedProduct->save();
                }
            }

            $upSells = explode(',', $row["up_sells_products"]);
            $upSellsProducts = Product::whereIn('code', $upSells)->pluck('id')->toArray();
            UpSaleProduct::where('product_id', $product->id)->whereNotIn('up_sale_id', $upSellsProducts)->delete();
            $selected = $product->upSaleIds();

            foreach ($upSellsProducts as $upSell) {
                if (!in_array($upSell, $selected)) {
                    $upSaleProduct =  new UpSaleProduct();
                    $upSaleProduct->product_id = $product->id;
                    $upSaleProduct->up_sale_id = $upSell;
                    $upSaleProduct->save();
                }
            }

            $crossSells = explode(',', $row["cross_sells_products"]);
            $crossSellsProducts = Product::whereIn('code', $crossSells)->pluck('id')->toArray();
            CrossSaleProduct::where('product_id', $product->id)->whereNotIn('cross_sale_id', $crossSellsProducts)->delete();
            $selected = $product->crossSaleIds();

            foreach ($crossSellsProducts as $crossSell) {
                if (!in_array($crossSell, $selected)) {
                    $crossSaleProduct =  new CrossSaleProduct();
                    $crossSaleProduct->product_id = $product->id;
                    $crossSaleProduct->cross_sale_id = $crossSell;
                    $crossSaleProduct->save();
                }
            }
        }
    }
}
