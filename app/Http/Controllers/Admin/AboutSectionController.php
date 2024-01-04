<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use App\Enums\AboutSectionType;
use App\Http\Controllers\Controller;

class AboutSectionController extends Controller
{
    public function sectionOneShow()
    {
        $aboutSection = AboutSection::where('key', AboutSectionType::SectionOne)->first();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "About Section One"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.about-sections.one', compact('aboutSection', 'langs', 'pageConfigs', 'breadcrumbs'));
    }

    public function sectionOneUpdate(Request $request, AboutSection $aboutSection)
    {
        try {
            $data = [];
            $oldData = json_decode($aboutSection->translateOrDefault()->data);

            foreach ($this->lang as $lang) {
                $tempData = [
                    'head' =>  trim($request->get('head_' . $lang['code'])),
                    'title' =>  trim($request->get('title_' . $lang['code'])),
                    'content' =>  trim($request->get('content_' . $lang['code'])),
                    'image' => $oldData->image
                ];

                if ($request->hasFile('image_' . $lang['code'])) {
                    $image = uploadFile('about_section', $request->file('image_' . $lang['code']));
                    $tempData['image'] = $image ? asset('storage/' . $image) : null;
                }

                $data[$lang['code']] = $tempData;
            }

            foreach ($this->lang as $lang) {
                $aboutSection->translateOrNew($lang['code'])->data = json_encode($data[$lang['code']]);
                $aboutSection->save();
            }
            return redirect(route('admin.about-section-one', $aboutSection))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function sectionTwoShow()
    {
        $aboutSection = AboutSection::where('key', AboutSectionType::SectionTwo)->first();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "About Section Two"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.about-sections.two', compact('aboutSection', 'langs', 'pageConfigs', 'breadcrumbs'));
    }

    public function sectionTwoUpdate(Request $request, AboutSection $aboutSection)
    {
        try {
            $data = [];
            $oldData = json_decode($aboutSection->translateOrDefault()->data);

            foreach ($this->lang as $lang) {
                $tempData = [
                    'title' =>  trim($request->get('title_' . $lang['code'])),
                    'content_1' =>  trim($request->get('content_1_' . $lang['code'])),
                    'content_2' =>  trim($request->get('content_2_' . $lang['code'])),
                    'image' => $oldData->image
                ];

                if ($request->hasFile('image_' . $lang['code'])) {
                    $image = uploadFile('about_section', $request->file('image_' . $lang['code']));
                    $tempData['image'] = $image ? asset('storage/' . $image) : null;
                }

                $data[$lang['code']] = $tempData;
            }

            foreach ($this->lang as $lang) {
                $aboutSection->translateOrNew($lang['code'])->data = json_encode($data[$lang['code']]);
                $aboutSection->save();
            }
            return redirect(route('admin.about-section-two', $aboutSection))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function sectionThreeShow()
    {
        $aboutSection = AboutSection::where('key', AboutSectionType::SectionThree)->first();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "About Section Three"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.about-sections.three', compact('aboutSection', 'langs', 'pageConfigs', 'breadcrumbs'));
    }

    public function sectionThreeUpdate(Request $request, AboutSection $aboutSection)
    {
        try {
            $data = [];
            $oldData = json_decode($aboutSection->translateOrDefault()->data);

            foreach ($this->lang as $lang) {
                $tempData = [
                    'title' =>  trim($request->get('title_' . $lang['code'])),
                    'content' =>  trim($request->get('content_' . $lang['code'])),
                    'image' => $oldData->image
                ];

                if ($request->hasFile('image_' . $lang['code'])) {
                    $image = uploadFile('about_section', $request->file('image_' . $lang['code']));
                    $tempData['image'] = $image ? asset('storage/' . $image) : null;
                }

                $data[$lang['code']] = $tempData;
            }

            foreach ($this->lang as $lang) {
                $aboutSection->translateOrNew($lang['code'])->data = json_encode($data[$lang['code']]);
                $aboutSection->save();
            }
            return redirect(route('admin.about-section-three', $aboutSection))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
