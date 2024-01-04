<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement('TRUNCATE model_has_permissions');
        DB::statement('TRUNCATE permissions');
        DB::statement('TRUNCATE role_has_permissions');
        DB::statement('TRUNCATE model_has_roles');
        DB::statement('TRUNCATE roles');
        DB::statement('TRUNCATE role_has_permissions');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $superAdminRole = Role::create(['name' => 'superadmin']);
        $adminRole = Role::create(['name' => 'admin']);

        $superAdminPermissions = [
            'walkthrough management',
            'staticPage management',
            'users management',
            'roles',
            'admin management',
            'customers management',
            'notifications management',
            'chat management',
            'transactions management',
            'subscriptions management',
            'influencers management',
            'categories management',
            'divisions management',
            'sub-categories management',
            'products management',
            'site management',
            'brands management',
            'coupons management',
            'addresses management',
            'driver management',
            'orders management',
            'qoutes management',
            'settings management',
            'tools management',
            'file manager management'
        ];

        $adminPermissions = [
            'walkthrough management',
            'staticPage management',
        ];

        foreach ($superAdminPermissions as $value) {
            Permission::create(['name' => $value]);
            $superAdminRole->givePermissionTo($value);
        }

        foreach ($adminPermissions as $value) {
            $adminRole->givePermissionTo($value);
        }

        Role::query()->update(['guard_name' => 'admin']);
        Permission::query()->update(['guard_name' => 'admin']);
    }
}
