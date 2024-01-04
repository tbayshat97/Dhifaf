<?php

namespace App\Http\Controllers\API;

use App\CustomClasses\Curl;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SapController extends Controller
{
    use ApiResponser;

    public function updateProduts(Request $request)
    {
        $date = null;

        if ($request->has('date') && $request->date) {
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Ymd');
        }

        try {
            $url = config('services.sap.base_url') . config('services.sap.get_items');
            Curl::prepare($url, []);

            if ($date) {
                Curl::prepare($url, ['date' => $date]);
            }

            Curl::exec_get();
            $response = Curl::get_response_assoc();

            foreach ($response["data"] as $value) {
                $product = Product::where('code', $value["ItemCode"])->first();

                if ($product && $value["ItemCode"]) {
                    $product->qty = $value["ItemAvaliableQty"];
                    $product->price = $value["ItemPrice"];
                    $product->save();
                } else {
                    $product = new Product();
                    $product->code = $value["ItemCode"];
                    $product->barcode = $value["ItemBarcode"];
                    $product->qty = $value["ItemAvaliableQty"];
                    $product->price = $value["ItemPrice"];
                    $product->save();
                }
            }
        } catch (\Exception $e) {
            return $this->errorResponse(401, $e->getMessage(), 401);
        }
    }

    public function updatePrices()
    {
        try {
            $url = config('services.sap.base_url') . config('services.sap.get_prices');
            Curl::prepare($url, []);

            Curl::exec_get();
            $response = Curl::get_response_assoc();
            $insert_data = [];
            foreach ($response["data"] as $value) {

                $data = [
                    'ItemCode' => $value['ItemCode'],
                    'Price' => $value['Price']
                ];

                $insert_data[] = $data;
            }
            $insert_data = collect($insert_data);
            $chunks = $insert_data->chunk(500);

            foreach ($chunks as $chunk) {
                foreach ($chunk as $value) {
                    Product::where('code', $value["ItemCode"])
                        ->update(['price' => $value["Price"]]);
                }
            }
        } catch (\Exception $e) {
            return $this->errorResponse(401, $e->getMessage(), 401);
        }
    }

    public function updateSearchAppearance(){
        $products = Product::all();
        foreach ($products as $product) {


            $group = ProductGroup::whereJsonContains('product_group', [$product->id])->first();
            if($group){
                $product->search_appearance = 0;
                $product->save();
            }
            else {
                $product->search_appearance = 1;
                $product->save();
            }

            $brand = $product->brand;
            if($brand){
                if($brand->status == 2){
                    $product->search_appearance = 0;
                    $product->save();
                }
                else{
                    $product->search_appearance = 1;
                $product->save();
                }
            }
        }

    }
}
