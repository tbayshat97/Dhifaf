<?php

namespace App\Http\Controllers\brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $brand = auth('brand')->user();

        return view('backend-brand.dashboard', compact('brand'));
    }
}
