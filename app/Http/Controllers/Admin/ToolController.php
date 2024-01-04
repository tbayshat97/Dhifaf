<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use App\Imports\SizesImport;
use App\Imports\CategoriesImport;
use App\Imports\SubCategoriesImport;

use Maatwebsite\Excel\Facades\Excel;


class ToolController extends Controller
{
    public function importProductsSap()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "SAP Products"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.tools.import-sap', compact('pageConfigs', 'breadcrumbs'));
    }

    public function importProductsExcel()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Excel Products"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.tools.import-excel', compact('pageConfigs', 'breadcrumbs'));
    }

    public function updateImportedProducts(Request $request)
    {
        try {
            Excel::import(new ProductsImport, $request->file('excel-file'));

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function importSizesExcel()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Excel Sizes"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.tools.import-sizes', compact('pageConfigs', 'breadcrumbs'));
    }

    public function addImportedSizes(Request $request)
    {
        try {
            Excel::import(new SizesImport, $request->file('excel-file'));

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function addImportedCategories(Request $request)
    {
        try {
            Excel::import(new CategoriesImport, $request->file('excel-file'));

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
    public function addImportedSubCategories(Request $request)
    {
        try {
            Excel::import(new SubCategoriesImport, $request->file('excel-file'));

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    // public function importCategoriesExcel()
    // {
    //     $breadcrumbs = [
    //         ['link' => "admin", 'name' => "Dashboard"], ['name' => "Excel Sizes"],
    //     ];

    //     $pageConfigs = ['pageHeader' => true];

    //     return view('backend.tools.import-sizes', compact('pageConfigs', 'breadcrumbs'));
    // }

    // public function addImportedCategories(Request $request)
    // {
    //     try {
    //         Excel::import(new SizesImport, $request->file('excel-file'));

    //         return redirect()->back()->with('success', __('system-messages.update'));
    //     } catch (\Exception $e) {
    //         $bug = $e->getMessage();
    //         return redirect()->back()->with('error', $bug);
    //     }
    // }

    public function fileManager()
    {
        return view('backend.file-manager.index');
    }
}
