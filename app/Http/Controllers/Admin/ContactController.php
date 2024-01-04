<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactEmail;
use App\Models\ContactLocation;
use Illuminate\Http\Request;
use App\Models\ContactInfo;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::where('id', 1)->first();
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Contacts"],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.contact.show', compact('contact', 'breadcrumbs', 'pageConfigs', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            foreach ($this->lang as $lang) {
                $contact->translateOrNew($lang['code'])->content = trim($request->get('content_' . $lang['code']));
                $contact->save();
            }

            // locations
            if ($request->location_old) {
                $old_location_ids = [];
                foreach ($request->location_old as $item) {
                    array_push($old_location_ids, $item['id']);
                    $contactLocation = ContactLocation::find($item['id']);

                    foreach ($this->lang as $lang) {
                        $contactLocation->translateOrNew($lang['code'])->country = trim($item['country_' . $lang['code']]);
                        $contactLocation->translateOrNew($lang['code'])->street = trim($item['street_' . $lang['code']]);
                        $contactLocation->translateOrNew($lang['code'])->area = trim($item['area_' . $lang['code']]);
                        $contactLocation->translateOrNew($lang['code'])->city = trim($item['city_' . $lang['code']]);
                        $contactLocation->save();
                    }
                }

                tap(ContactLocation::where('contact_id', $contact->id)->whereNotIn('id', $old_location_ids)->delete());
            } else {
                tap(ContactLocation::where('contact_id', $contact->id)->delete());
            }

            if ($request->locations) {
                foreach ($request->locations as $item) {
                    $contactLocation = new ContactLocation();
                    $contactLocation->contact_id = $contact->id;
                    $contactLocation->save();
                    foreach ($this->lang as $lang) {
                        $contactLocation->translateOrNew($lang['code'])->country = trim($item['location_country_' . $lang['code']]);
                        $contactLocation->translateOrNew($lang['code'])->street = trim($item['location_street_' . $lang['code']]);
                        $contactLocation->translateOrNew($lang['code'])->area = trim($item['location_area_' . $lang['code']]);
                        $contactLocation->translateOrNew($lang['code'])->city = trim($item['location_city_' . $lang['code']]);
                        $contactLocation->save();
                    }
                }
            }

            // infos
            if ($request->info_old) {
                $old_info_ids = [];
                foreach ($request->info_old as $item) {
                    array_push($old_info_ids, $item['id']);
                    $contactInfo = ContactInfo::find($item['id']);
                    $contactInfo->phone = $item['phone'];

                    foreach ($this->lang as $lang) {
                        $contactInfo->translateOrNew($lang['code'])->title = trim($item['title_' . $lang['code']]);
                        $contactInfo->save();
                    }
                }

                tap(ContactInfo::where('contact_id', $contact->id)->whereNotIn('id', $old_info_ids)->delete());
            } else {
                tap(ContactInfo::where('contact_id', $contact->id)->delete());
            }

            if ($request->infos) {
                foreach ($request->infos as $item) {
                    $contactInfo = new ContactInfo();
                    $contactInfo->contact_id = $contact->id;
                    $contactInfo->phone = $item['info_phone'];
                    $contactInfo->save();
                    foreach ($this->lang as $lang) {
                        $contactInfo->translateOrNew($lang['code'])->title = trim($item['info_title_' . $lang['code']]);
                        $contactInfo->save();
                    }
                }
            }

            // emails
            if ($request->email_old) {
                $old_email_ids = [];
                foreach ($request->email_old as $item) {
                    // dd('hi');
                    array_push($old_email_ids, $item['id']);
                    $contactEmail = ContactEmail::find($item['id']);
                    $contactEmail->email = $item['email'];
                    $contactEmail->save();
                }
                tap(ContactEmail::where('contact_id', $contact->id)->whereNotIn('id', $old_email_ids)->delete());
            } else {
                tap(ContactEmail::where('contact_id', $contact->id)->delete());
            }

            if ($request->emails) {
                foreach ($request->emails as $item) {
                    $contactEmail = new ContactEmail();
                    $contactEmail->contact_id = $contact->id;
                    $contactEmail->email = $item['info_email'];
                    $contactEmail->save();
                }
            }

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
