<?php

namespace App\Http\Controllers\API\Customer;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethods;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\OrderRequest;
use App\Http\Resources\Order as ResourcesOrder;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderItemCollection;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponser;

    public function list(Request $request)
    {
        $customer = auth()->user();

        $query = $customer->orders();

        $type = intval($request->type);

        switch ($type) {
            case OrderStatus::Finished:
                $query->whereIn('status', [OrderStatus::Finished])
                    ->orderBy('created_at', 'desc');
                break;
            case OrderStatus::Pending:
                $query->whereIn('status', [OrderStatus::Pending])
                    ->orderBy('created_at', 'desc');
                break;
            case OrderStatus::Canceled:
                $query->whereIn('status', [OrderStatus::Canceled])
                    ->whereDate('created_at', Carbon::today())
                    ->orderBy('created_at', 'desc');
                break;
        }

        $orders = $query->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new OrderCollection($orders));
    }

    public function store(OrderRequest $request)
    {
        $customer = auth()->user();
        $default_address = null;

        if ($customer->defaultCustomerAddress()->count() != 0) {
            $default_address = $customer->defaultCustomerAddress()->first();
        }

        $maxProductQty = Setting::where('option_key', 'minimum_qty')->first();
        $maxProductQty = $maxProductQty->option_value;

        //Even if the product is available, it must not be less than the value entered by the admin

        $can_buy = true;
        foreach ($request->products as $value) {
            $product = Product::find($value['product_id']);
            if (!(($value['qty'] <= $product->qty) && ($value['qty'] <= $product->qty - $maxProductQty))) {
                $can_buy = false;
                break;
            }
        }

        if (!$can_buy) {
            return $this->errorResponse(66, trans('api.order.min_max'), 200);
        }

        if (!$default_address) {
            return $this->errorResponse(66, trans('api.order.address'), 200);
        }

        # make order
        $delivery = 0;
        $discount = 0;
        $subTotal = 0;

        $customer_order = new Order();
        $customer_order->customer_id = $customer->id;
        $customer_order->customer_address_id = $default_address->id;
        $customer_order->order_number = $this->generateUniqueNumber($customer);
        $customer_order->total_cost = 0;
        $customer_order->payment_method = PaymentMethods::CashOnDelivery;
        $customer_order->status = OrderStatus::Pending;
        $customer_order->save();

        foreach ($request->products as $value) {
            $product = Product::find($value['product_id']);

            $orderItem = new OrderItem();
            $orderItem->order_id = $customer_order->id;
            $orderItem->product_id = intval($value['product_id']);
            $orderItem->qty = $value['qty'];
            $orderItem->price = $this->claculateSubTotal($value['qty'], $product->price);
            $orderItem->save();

            $subTotal += $this->claculateSubTotal($value['qty'], $product->price);

            if ($product->sale_price) {
                $discount += $this->claculateDiscount($value['qty'], $product->sale_price);
            }
        }

        # save total_cost & total discount
        $customer_order->sub_total = $subTotal;
        $customer_order->discount = $discount;
        $customer_order->delivery_total = $delivery;
        $customer_order->total_cost = $this->claculateTotalPrice($subTotal, $discount) + $delivery;
        $customer_order->save();

        return $this->successResponse(200, trans('api.order.submit'), 200, new ResourcesOrder($customer_order));
    }


    public function cart(Request $request)
    {
        $result = [];
        $maxProductQty = Setting::where('option_key', 'minimum_qty')->first();
        $maxProductQty = $maxProductQty->option_value;

        //Even if the product is available, it must not be less than the value entered by the admin

        foreach ($request->products as $value) {
            $product = Product::find($value['product_id']);

            array_push($result, [
                'product_id' => $product->id,
                'max_qty' => $product->qty - $maxProductQty,
                'out_of_stock' => ($product->qty - $maxProductQty) < 0,
                'can_buy' => (($value['qty'] <= $product->qty) && ($value['qty'] <= $product->qty - $maxProductQty)),
                'current_ordered_qty' => $value['qty']
            ]);
        }

        return $this->successResponse(200, trans('api.order.submit'), 200, ['products' => $result]);
    }

    public function reOrder(Request $request)
    {
        $previousOrder = Order::find($request->order_id);

        $order = $previousOrder->replicate();
        $order->payment_method = PaymentMethods::CashOnDelivery;
        $order->status = OrderStatus::Pending;
        $order->created_at = Carbon::now();
        $order->save();

        foreach ($previousOrder->items as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->qty = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->save();
        }

        return $this->successResponse(200, trans('api.order.submit'), 200, new ResourcesOrder($order));
    }

    public function show(Order $order)
    {
        $result = [
            'order' => new ResourcesOrder($order),
            'items' => new OrderItemCollection($order->items)
        ];

        return $this->successResponse(200, trans('api.public.done'), 200, $result);
    }

    protected function claculateTotalPrice($subTotal, $discount)
    {
        return $subTotal - $discount;
    }

    protected function claculateSubTotal($qty, $price)
    {
        return $qty * $price;
    }

    protected function claculateDiscount($qty, $price)
    {
        return $qty * $price;
    }

    protected function generateUniqueNumber($customer)
    {
        return date('ymd') . $customer->id . strtoupper(substr(uniqid(sha1(time())), 0, 4));
    }
}
