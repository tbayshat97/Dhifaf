<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsitePage;
use Illuminate\Http\Request;

class WebsitePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Website Pages"],
        ];

        $pageConfigs = ['pageHeader' => true];

        $websitePage = WebsitePage::all();
        return view('backend.websitePages.list', compact('websitePage', 'breadcrumbs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebsitePage  $websitePage
     * @return \Illuminate\Http\Response
     */
    public function show(WebsitePage $websitePage)
    {
        $langs = $this->lang;
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/website-page", 'name' => "Website Pages"], ['name' => "Update"]
        ];
        $pageConfigs = ['pageHeader' => true];
        return view('backend.websitePages.show', compact(['websitePage', 'langs', 'breadcrumbs', 'pageConfigs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebsitePage  $websitePage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebsitePage $websitePage)
    {
        try {
            foreach ($this->lang as $lang) {
                $websitePage->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $websitePage->translateOrNew($lang['code'])->content = trim($request->get('content_' . $lang['code']));
                $websitePage->save();
            }

            return redirect(route('admin.website-page.show', $websitePage->id))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebsitePage  $websitePage
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsitePage $websitePage)
    {
        $websitePage->delete();
        return redirect(route('admin.websitePages.index'))->with('success', __('system-messages.delete'));
    }
}
