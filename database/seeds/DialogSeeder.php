<?php

use App\Models\Influencer;
use App\Models\Customer;
use App\Models\Dialog;
use App\Models\DialogMessage;
use App\Models\User;
use Illuminate\Database\Seeder;

class DialogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::all();
        $influencers = Influencer::all();

        foreach ($customers as $customer) {
            $dialog = new Dialog();
            $dialog->accountable_type = Customer::class;
            $dialog->accountable_id = $customer->id;
            $dialog->save();

            $dialogMessage = new DialogMessage();
            $dialogMessage->dialog_id = $dialog->id;
            $dialogMessage->from_accountable_type = Customer::class;
            $dialogMessage->from_accountable_id = $customer->id;
            $dialogMessage->to_accountable_type = User::class;
            $dialogMessage->to_accountable_id = 1;
            $dialogMessage->message = 'Hello Admin';
            $dialogMessage->save();
        }

        foreach ($influencers as $influencer) {
            $dialog = new Dialog();
            $dialog->accountable_type = Influencer::class;
            $dialog->accountable_id = $influencer->id;
            $dialog->save();

            $dialogMessage = new DialogMessage();
            $dialogMessage->dialog_id = $dialog->id;
            $dialogMessage->from_accountable_type = Influencer::class;
            $dialogMessage->from_accountable_id = $influencer->id;
            $dialogMessage->to_accountable_type = User::class;
            $dialogMessage->to_accountable_id = 1;
            $dialogMessage->message = 'Hello Admin';
            $dialogMessage->save();
        }
    }
}
