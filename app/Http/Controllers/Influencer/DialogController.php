<?php

namespace App\Http\Controllers\Influencer;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\Influencer;
use App\Models\Customer;
use App\Models\Dialog;
use App\Models\DialogMessage;
use App\Models\User;
use Illuminate\Http\Request;

class DialogController extends Controller
{
    public function chat()
    {
        $customers = Customer::all();

        $breadcrumbs = [
            ['link' => "influencer", 'name' => "Dashboard"], ['name' => "Customers"],
        ];

        $pageConfigs = ['pageHeader' => false];

        $dialog = Dialog::where(['accountable_type' => Influencer::class, 'accountable_id' => auth('influencer')->user()->id])->first();

        return view('backend-influencer.dialogs.chat', compact('customers', 'breadcrumbs', 'pageConfigs', 'dialog'));
    }

    public function chatMessages(Dialog $dialog)
    {
        $dialog->messages()->update(['is_read' => true]);

        $messages = $dialog->messages;
        $account = $this->getDialogUser($dialog->accountable_type, $dialog->accountable_id);

        return view('backend-influencer.dialogs.chat-content', compact('dialog', 'account', 'messages'));
    }

    protected function getDialogUser($accountable_type, $accountable_id)
    {
        $account = null;

        if ($accountable_type === Influencer::class) {
            $account = Influencer::find($accountable_id);
        }

        return $account;
    }

    public function sendMessage(Dialog $dialog, Request $request)
    {
        $influencer = auth('influencer')->user();

        $dialog = Dialog::where([
            'accountable_type' => Influencer::class,
            'accountable_id' => $influencer->id
        ])->first();

        if (!$dialog) {
            $dialog = new Dialog();
            $dialog->accountable_type = Influencer::class;
            $dialog->accountable_id = $influencer->id;
            $dialog->save();
        }

        $dialog->update(
            ['updated_at' => now()]
        );

        $dialogMessage = new DialogMessage();
        $dialogMessage->dialog_id = $dialog->id;
        $dialogMessage->from_accountable_type = Influencer::class;
        $dialogMessage->from_accountable_id = $influencer->id;
        $dialogMessage->to_accountable_type = User::class;
        $dialogMessage->to_accountable_id = User::first()->id;
        $dialogMessage->message = $request->message;
        $dialogMessage->is_read = false;
        $dialogMessage->save();

        $data = [
            'dialog' => $dialog,
            'dialogMessage' => $dialogMessage,
            'accountImage' => $influencer->profile->getProfileImage() ? asset($influencer->profile->getProfileImage()) : asset('images/placeholders/user.png'),
            'lastMessageDate' => $dialogMessage->created_at->format('g:i A'),
            'unreadMessagesCount' => $dialog->unreadMessages()
        ];

        event(new NewMessage($data));
    }

    public function sidebar()
    {
        $dialogs = Dialog::where(['accountable_type' => Influencer::class, 'accountable_id' => auth('influencer')->user()->id])->get();

        $dialogs->each(function ($dialog) {
            $dialog->account = $this->getDialogUser($dialog->accountable_type, $dialog->accountable_id);
        });

        return view('backend-influencer.dialogs.sidebar', compact('dialogs'));
    }

    public function readAll(Dialog $dialog)
    {
        $dialog->messages()->update(
            ['is_read' => true]
        );
    }
}
