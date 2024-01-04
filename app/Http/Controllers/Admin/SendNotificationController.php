<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerNotification;
use Illuminate\Http\Request;

class SendNotificationController extends Controller
{
    public function sendNotificationPage()
    {
        return view('backend.notifications.send-page');
    }

    public function send(Request $request)
    {
        $validations = [
            'title' => 'required',
            'type' => 'required',
            'message' => 'required',
        ];

        $request->validate($validations);

        try {
            $this->setConfAndSend($request->type, $request->title, $request->message, $request->gender, $request->send_at);
            return redirect()->back()->with('success', __('system-messages.done'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());;
        }
    }

    protected function setConfAndSend($type, $title, $message, $gender = null, $send_at = null)
    {
        if ($type == Customer::class) {
            $users = Customer::query();

            if ($gender) {
                $users = $users->whereHas('profile', function ($q) use ($gender) {
                    $q->where('gender', $gender);
                });
            }

            $users = $users->whereNotNull('fcm_token')->get(['id', 'fcm_token']);
        }

        $tokens = [];

        foreach ($users as $value) {
            $notification = new CustomerNotification();
            $notification->customer_id = $value->id;
            $notification->title = $title;
            $notification->content = $message;
            $notification->send_at = $send_at;
            $notification->save();

            array_push($tokens, $value->fcm_token);
        }

        if (!$send_at) {
            $this->sendNotification(
                $tokens,
                $title,
                $message
            );
        }
    }
}
