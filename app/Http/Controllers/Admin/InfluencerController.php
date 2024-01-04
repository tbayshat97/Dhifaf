<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Models\Influencer;
use App\Models\InfluencerProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InfluencerRequest;
use App\Http\Requests\Admin\UpdateInfluencerRequest;

class InfluencerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $influencers = Influencer::all();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Influencers"],
        ];

        $addNewBtn = "admin.influencer.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.influencers.list', compact('influencers', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/influencer", 'name' => "Influencers"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend.influencers.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InfluencerRequest $request)
    {
        try {
            $influencer = new Influencer();
            $influencer->username = $request->username;
            $influencer->account_verified_at = Carbon::now();
            $influencer->password = bcrypt($request->password);
            foreach ($this->lang as $lang) {
                $influencer->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $influencer->translateOrNew($lang['code'])->bio = trim($request->get('bio_' . $lang['code']));

                $influencer->save();
            }
            $influencer->save();
            $influencerProfile = new InfluencerProfile();
            if ($request->file('image')) {
                $image = uploadFile('influencer', $request->file('image'));
                $influencerImage[] = saveFileUploaderMedia($image, $request->file('image'), 'influencer');
            }

            if ($request->file('header')) {
                $header = uploadFile('influencer', $request->file('header'));
                $influencerHeader[] = saveFileUploaderMedia($header, $request->file('header'), 'influencer');
            }

            $influencerProfile->influencer_id = $influencer->id;
            $influencerProfile->image = json_encode($influencerImage);
            $influencerProfile->header = json_encode($influencerHeader);
            $influencerProfile->phone = $request->phone;
            $influencerProfile->percentage = $request->percentage;
            $influencerProfile->birthdate = Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('Y-m-d');;
            $influencerProfile->facebook_link = $request->facebook_link;
            $influencerProfile->twitter_link = $request->twitter_link;
            $influencerProfile->linkedin_link = $request->linkedin_link;
            $influencerProfile->gender = $request->gender;

            $influencerProfile->save();

            return redirect(route('admin.influencer.show', $influencer))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Influencer  $influencer
     * @return \Illuminate\Http\Response
     */
    public function show(Influencer $influencer)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/influencer", 'name' => "Influencers"], ['name' => "update"]
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.influencers.show', compact(['langs', 'pageConfigs', 'breadcrumbs', 'influencer']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Influencer  $influencer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInfluencerRequest $request, Influencer $influencer)
    {
        try {
            if ($request->password) {
                $influencer->password = bcrypt($request->password);
            }
            foreach ($this->lang as $lang) {
                $influencer->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                $influencer->translateOrNew($lang['code'])->bio = trim($request->get('bio_' . $lang['code']));

                $influencer->save();
            }
            $influencer->is_blocked = $request->has('is_blocked') ? true : false;
            $influencer->save();


            $influencerProfile = InfluencerProfile::where('influencer_id', $influencer->id)->first();
            $influencerProfile->phone = $request->phone;
            $influencerProfile->facebook_link = $request->facebook_link;
            $influencerProfile->twitter_link = $request->twitter_link;
            $influencerProfile->linkedin_link = $request->linkedin_link;
            if ($request->birthdate) {
                $dob = DateTime::createFromFormat('d/m/Y', $request->birthdate);
                $influencerProfile->birthdate = $dob->format('Y-m-d');
            }
            $influencerProfile->gender = $request->gender ? intval($request->gender) : null;
            if ($request->file('image')) {
                $oldImage = $influencerProfile->getProfileImage();
                $image = uploadFile('influencer', $request->file('image'), $oldImage);
                $influencerImage[] = saveFileUploaderMedia($image,  $request->file('image'), 'influencer');

                $influencerProfile->image = json_encode($influencerImage);
            }

            $influencerHeader = [];
            if ($request->file('header')) {
                $oldImage = $influencerProfile->getProfileHeader();
                $header = uploadFile('influencer', $request->file('header'), $oldImage);
                $influencerHeader[] = saveFileUploaderMedia($header,  $request->file('header'), 'influencer');

                $influencerProfile->header = json_encode($influencerHeader);
            }

            $influencerProfile->save();

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Influencer  $influencer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Influencer $influencer)
    {
        //
    }
}
