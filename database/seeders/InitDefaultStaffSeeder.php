<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitDefaultStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $staff */
        $staff = User::create([
            'name' => 'staff_1',
            'email' => 'staff1@gmail.com',
            'password' => Hash::make(123456789),
        ]);

        $staff->assignRole('staff');
    }
}
