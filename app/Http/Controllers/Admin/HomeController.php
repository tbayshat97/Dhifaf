<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function dashboard()
    {
        $date = Carbon::today()->subDays(7);

        // statistics
        $newOrders = Customer::where('created_at', '>=', $date)->count();
        $orders = Order::count();
        $newClients = Customer::where('created_at', '>=', $date)->count();
        $clients = Customer::count();
        $newProducts = Product::where('created_at', '>=', $date)->count();
        $products = Product::count();
        $newBrands = Brand::where('created_at', '>=', $date)->count();
        $brands = Brand::count();

        // This year vs Last year revenue
        $thisYear = Carbon::now()->format('Y');
        $lastYear = Carbon::now()->subWeeks(52)->format('Y');

        $thisYearRevenueData = [];
        $lastYearRevenueData = [];

        $months = allMonths(); // From helper.

        foreach ($months as $value) {
            $thisYearRevenueData[$value] =  Order::whereYear('created_at', $thisYear)->whereMonth('created_at', $value)->sum('total_cost');
            $lastYearRevenueData[$value] =  Order::whereYear('created_at', $lastYear)->whereMonth('created_at', $value)->sum('total_cost');
        }

        // Weekly revenue
        $weekAgo = Carbon::now()->subDays(7)->startOfDay();
        $firstWeekDay = Carbon::now()->subDays(7)->format('F j');
        $lastWeekDay = Carbon::now()->format('F j');

        $weekRevenue = Order::where('created_at', '>=', $weekAgo)->get();

        $weekRevenueDataIndex = [];
        $weekRevenueDataValue = [];

        $weekTotal = 0;

        foreach ($weekRevenue as $key => $value) {
            $weekRevenueDataIndex[] = $value->created_at->format('d');
            $weekRevenueDataValue[] = $value->total_cost;

            $weekTotal += $value->total_cost;
        }

        // Today revenue
        $today = Carbon::now()->format('Y-m-d');

        $todayRevenue = Order::whereDate('created_at', $today)->get();

        $todayRevenueDataIndex = [];
        $todayRevenueDataValue = [];

        $todayTotal = 0;

        foreach ($todayRevenue as $key => $value) {
            $todayRevenueDataIndex[] = $value->created_at->format('g:i A');
            $todayRevenueDataValue[] = $value->total_cost;

            $todayTotal += $value->total_cost;
        }

        return view('backend.dashboard', compact('todayTotal', 'todayRevenueDataIndex', 'todayRevenueDataValue', 'firstWeekDay', 'lastWeekDay', 'thisYear', 'thisYearRevenueData', 'lastYearRevenueData', 'orders', 'newOrders', 'clients', 'newClients', 'newProducts', 'products', 'newBrands', 'brands', 'weekTotal', 'weekRevenueDataIndex', 'weekRevenueDataValue'));
    }
}
