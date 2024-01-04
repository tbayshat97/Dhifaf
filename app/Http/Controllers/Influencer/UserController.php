<?php

namespace App\Http\Controllers\Influencer;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\RequiredIf;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $influencer = auth('influencer')->user();

        $breadcrumbs = [
            ['link' => "influencer", 'name' => "Dashboard"], ['link' => "influencer/profile", 'name' => "Profile"], ['name' => "Update"]
        ];

        $langs = $this->lang;

        $pageConfigs = ['pageHeader' => true];

        return view('backend-influencer.users.profile', compact('influencer', 'langs', 'breadcrumbs', 'pageConfigs'));
    }

    public function updateProfile(Request $request)
    {
        $rules = [];
        $step = intval($request->step);

        switch ($step) {
            case 1:
                $rules = [
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'phone' => 'required',
                    "image" => new RequiredIf($request['fileuploader-list-image'] == json_encode([])) . '|mimes:' . config('services.allowed_file_extensions.images'),
                    "gallery.*" => 'nullable|mimes:' . config('services.allowed_file_extensions.images'),
                ];
                break;
            case 2:
                $rules = [
                    'password' => 'required|min:6|confirmed'
                ];
                break;
            case 3:
                $rules = [
                    'percentage' => 'required'
                ];
                break;
            case 4:
                // for future purposes
                break;
        }

        $request->validate($rules);

        try {
            $influencer = auth('influencer')->user();

            if ($request->password) {
                $influencer->password = bcrypt($request->password);
            }

            if ($request->has('name_en') && $request->has('name_ar')) {
                foreach ($this->lang as $lang) {
                    $influencer->translateOrNew($lang['code'])->name = trim($request->get('name_' . $lang['code']));
                }
            }

            if ($request->has('bio_en') && $request->has('bio_ar')) {
                foreach ($this->lang as $lang) {
                    $influencer->translateOrNew($lang['code'])->bio = trim($request->get('bio_' . $lang['code']));
                }
            }

            $influencer->save();

            if ($request->has('phone')) {
                $influencer->profile->phone = $request->phone;
            }

            if ($request->has('percentage')) {
                $influencer->profile->percentage = $request->percentage;
            }

            if ($request->has('birthdate') && $request->birthdate) {
                $dob = DateTime::createFromFormat('d/m/Y', $request->birthdate);
                $influencer->profile->birthdate = $dob->format('Y-m-d');
            }

            if ($request->has('gender')) {
                $influencer->profile->gender = $request->gender ? intval($request->gender) : null;
            }

            if ($request->file('image')) {
                $oldImage = $influencer->profile->getProfileImage();
                $image = uploadFile('influencer', $request->file('image'), $oldImage);
                $artistImage[] = saveFileUploaderMedia($image,  $request->file('image'), 'influencer');

                $influencer->profile->image = json_encode($artistImage);
            }

            if ($request->has('fileuploader-list-gallery')) {
                $current_images = getCurrentFileUploaderMedia($request->get('fileuploader-list-gallery'));

                $updated_images = getUpdatedFileUploaderMedia($influencer->profile->gallery, $current_images);

                if ($request->hasfile('gallery')) {
                    foreach ($request->file('gallery') as $file) {
                        $image = uploadFile('influencer', $file);
                        $updated_images[] = saveFileUploaderMedia($image,  $file, 'influencer');
                    }
                }
                $influencer->profile->gallery = json_encode($updated_images);
            }

            if ($request->has('facebook_link')) {
                $influencer->profile->facebook_link = $request->facebook_link;
            }

            if ($request->has('twitter_link')) {
                $influencer->profile->twitter_link = $request->twitter_link;
            }

            if ($request->has('linkedin_link')) {
                $influencer->profile->linkedin_link = $request->linkedin_link;
            }

            $influencer->profile->save();

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
