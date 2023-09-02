<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insertOrIgnore([
            [
                'id' => 0,
                'name' => 'Creating',
                'slug' => 'creating',
            ],
            [
                'id' => 2,
                'name' => 'Waiting confirm',
                'slug' => 'waiting-confirm',
            ],
            [
                'id' => 3,
                'name' => 'Confirmed',
                'slug' => 'confirmed',
            ],
            [
                'id' => 4,
                'name' => 'Shipping',
                'slug' => 'shipping',
            ],
            [
                'id' => 5,
                'name' => 'Arrived',
                'slug' => 'arrived',
            ],
            [
                'id' => 6,
                'name' => 'Delivered',
                'slug' => 'delivered',
            ],
            [
                'id' => 7,
                'name' => 'Cancelled',
                'slug' => 'cancelled',
            ],
        ]);
    }
}
