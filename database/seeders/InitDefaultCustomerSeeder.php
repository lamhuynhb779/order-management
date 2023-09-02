<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitDefaultCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $customer */
        $customer = User::create([
            'name' => 'customer_1',
            'email' => 'customer1@gmail.com',
            'password' => Hash::make(123456789),
        ]);

        $customer->assignRole('customer');
    }
}
