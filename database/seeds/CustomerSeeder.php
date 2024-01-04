<?php

use App\Models\ClientVisit;
use App\Models\Consultant;
use App\Models\ConsultantClient;
use App\Models\Customer;
use App\Models\CustomerProfile;
use App\Models\CustomerSubscription;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CustomerProfile::class, 2)->create();

        Customer::find(1)->update([
            'username' => '962796507289',
            'is_blocked' => false,
        ]);
    }
}
