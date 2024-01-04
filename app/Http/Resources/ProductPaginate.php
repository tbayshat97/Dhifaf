<?php

namespace App\Http\Resources;

use App\Enums\StockStatus;
use App\Models\ProductGroup;
use App\Models\Product as ModelsProduct;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPaginate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $stock_status = StockStatus::fromValue($this->stock_status);

        $data = [
            'product_id' => $this->id,
            'product_code' => $this->code,
            'product_barcode' => $this->barcode,
            'product_qty' => $this->qty,
            'product_brand' => Brand::make($this->brand),
            'product_sub_brand' => Brand::make($this->sub_brand),
            'product_category' => Category::collection($this->categories()),
            'product_sub_category' => SubCategory::collection($this->sub_categories()),
            'product_size' => Size::make($this->size),
            'product_color' => Color::make($this->color),
            'product_name' => $this->translateOrDefault()->title,
            'product_slug' => $this->translateOrDefault()->slug,
            'product_description' => $this->translateOrDefault()->description,
            'product_ingredients' => $this->translateOrDefault()->ingredients,
            'product_how_to_use' => $this->translateOrDefault()->how_to_use,
            'product_image' => ((!is_null($this->image)) ? $this->getProductImage() : 'https://via.placeholder.com/512/?text=Dhifaf'),
            'product_gallery' => $this->getProductGallery(),
            'product_price' => round((float) $this->price, 2),
            'product_sale_price' => (!is_null($this->sale_price)) ? round((float) $this->sale_price, 2) : null,
            'product_sale_price_percentage' => (!is_null($this->sale_price)) ? number_format((($this->price - $this->sale_price) * 100) / $this->price)  . '%' : null,
            'product_tags' => $this->tags ? json_decode($this->tags) : null,
            'product_meta_title' => $this->meta_title,
            'product_meta_description' => $this->meta_description,
            'product_rate' => starRatingsCalculator(ModelsProduct::class, $this->id),
            'product_reviews' => Review::collection($this->reviews),
            'product_stock_status' => [
                'key' => $stock_status->key,
                'name' => $stock_status->description,
                'value' => $stock_status->value,
            ],
            'product_is_new' => $this->new_arrival,
            'product_is_featured' => $this->is_featured
        ];

        $is_variant = $this->is_variant || count($this->groupMember());

        if ($is_variant) {
            $data['product_is_variant'] = true;
            $data['product_switcher'] = $this->getProductSwitcher();
            $data['product_group'] = (($this->is_variant && $this->group) ? MiniProductSwitcher::collection($this->group->minProducts()) : MiniProductSwitcher::collection($this->groupMember()));
        }

        return $data;
    }
}
