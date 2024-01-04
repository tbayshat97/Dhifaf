<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function products()
    {
        $ids = $this->product_group ? json_decode($this->product_group) : [];
        return Product::where('id', '<>', $this->product_id)->whereIn('id', $ids)->get();
    }

    public function minProducts()
    {
        $ids = $this->product_group ? json_decode($this->product_group) : [];
        array_push($ids, $this->product_id);
        //dd($ids);
        $data = Product::whereIn('id', $ids)->with('translation')->get(['id', 'switcher']);
        return  $data;
    }

    public function maxPrice()
    {
        $ids = $this->product_group ? json_decode($this->product_group) : [];
        return Product::where('id', '<>', $this->product_id)->whereIn('id', $ids)->max('price');
    }

    public function minPrice()
    {
        $ids = $this->product_group ? json_decode($this->product_group) : [];
        return Product::where('id', '<>', $this->product_id)->whereIn('id', $ids)->min('price');
    }

    public function productsIds()
    {
        $all = $this->product_group ? json_decode($this->product_group) : [];
        $all[] = $this->product_id;
        return $all;
    }
}
