<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => 'Dashboard'], ['name' => 'Qouts'],
        ];
        $pageConfigs = ['pageHeader' => true];

        $quotes = Quote::all();

        return view('backend.quotes.list', compact('quotes', 'breadcrumbs', 'pageConfigs'));
    }
}
