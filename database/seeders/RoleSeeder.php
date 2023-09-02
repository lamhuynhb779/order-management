<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Role $staffRole */
        $staffRole = Role::create(['name' => 'staff']);
        /** @var Role $customerRole */
        $customerRole = Role::create(['name' => 'customer']);

        $permissionViewHomepage = Permission::create(['name' => 'view homepage']);
        $permissionViewOrderManagement = Permission::create(['name' => 'view order management']);
        $permissionViewStateManagement = Permission::create(['name' => 'view state management']);

        $staffRole->givePermissionTo($permissionViewHomepage);
        $staffRole->givePermissionTo($permissionViewOrderManagement);
        $staffRole->givePermissionTo($permissionViewStateManagement);

        $customerRole->givePermissionTo($permissionViewHomepage);
    }
}
