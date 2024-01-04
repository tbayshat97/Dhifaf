<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        $breadcrumbs = [
            ['link' => "admin", 'name' => 'Dashboard'], ['name' => 'Orders'],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.orders.list', compact('orders', 'breadcrumbs', 'pageConfigs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => 'Dashboard'], ['link' => "admin/order", 'name' => 'Orders'], ['name' => 'Update']
        ];
        $drivers = Driver::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->fullname];
        });
        $pageConfigs = ['pageHeader' => true];

        return view('backend.orders.show', compact(['order', 'drivers', 'breadcrumbs', 'pageConfigs']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        try {
            $order->driver_id = $request->driver_id;
            $order->save();

            return redirect(route('admin.order.show', $order))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
