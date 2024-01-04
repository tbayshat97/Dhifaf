<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SectionType;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function headerShow()
    {
        $section = Section::where('key', SectionType::Header)->first();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Header Sections"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.sections.header', compact('section', 'langs', 'pageConfigs', 'breadcrumbs'));
    }

    public function headerUpdate(Request $request, Section $section)
    {
        try {
            $data = [];

            foreach ($this->lang as $lang) {
                $tempData = [
                    'content' =>  trim($request->get('content_' . $lang['code'])),
                ];
                $data[$lang['code']] = $tempData;
            }

            foreach ($this->lang as $lang) {
                $section->translateOrNew($lang['code'])->data = json_encode($data[$lang['code']]);
                $section->save();
            }

            return redirect(route('admin.section-header', $section))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function footerUpdate(Request $request, Section $section)
    {
        try {
            $data = [];

            foreach ($this->lang as $lang) {
                $tempData = [
                    'content' =>  trim($request->get('content_' . $lang['code'])),
                ];
                $data[$lang['code']] = $tempData;
            }

            foreach ($this->lang as $lang) {
                $section->translateOrNew($lang['code'])->data = json_encode($data[$lang['code']]);
                $section->save();
            }

            return redirect(route('admin.section-footer', $section))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function footerShow()
    {
        $section = Section::where('key', SectionType::Footer)->first();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Footer Sections"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.sections.footer', compact('section', 'langs', 'pageConfigs', 'breadcrumbs'));
    }
}
