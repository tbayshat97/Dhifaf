<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FollowUs;
use Illuminate\Http\Request;

class FollowUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Social Media Links"],
        ];

        $pageConfigs = ['pageHeader' => true];

        $followUs = FollowUs::all();
        return view('backend.socialMediaLinks.list', compact('followUs', 'breadcrumbs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUs  $followUs
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUs $followUs)
    {
        $langs = $this->lang;
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/social-media", 'name' => "Social Media Links"], ['name' => "Update"]
        ];
        $pageConfigs = ['pageHeader' => true];
        return view('backend.socialMediaLinks.show', compact(['followUs', 'langs', 'breadcrumbs', 'pageConfigs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUs  $followUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUs $followUs)
    {
        try {
            foreach ($this->lang as $lang) {
                $followUs->nice_name = trim($request->nice_name);
                $followUs->link = trim($request->link);
                $followUs->save();
            }

            return redirect(route('admin.social-media.show', $followUs->id))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowUs  $followUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUs $followUs)
    {
        $followUs->delete();
        return redirect(route('admin.socialMediaLinks.index'))->with('success', __('system-messages.delete'));
    }
}
