<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insertOrIgnore([
            [
                'id' => 1,
                'name_en' => 'Viet Nam',
                'name_vi' => 'Việt Nam',
            ],
        ]);
    }
}
