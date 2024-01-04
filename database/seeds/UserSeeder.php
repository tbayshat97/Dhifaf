<?php

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserProfile::class, 2)->create();

        $user = User::find(1);
        $user->update([
            'username' => 'devops@tubishat.info',
        ]);
        $user->assignRole('superadmin');

        $users = User::where('id', '!=', 1)->get();

        foreach ($users as $key => $value) {
            $value->username = 'admin' . $key . '@dhifaf-baghdad.net';
            $value->save();
            $value->assignRole('admin');
        }
    }
}
