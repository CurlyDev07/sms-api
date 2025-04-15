<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        DB::table('customer_infos')->insert([
            [
                'name' => 'John Doe',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Jane Smith',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Mark Johnson',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Emily Davis',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Lucas White',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Sophia Brown',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Isabella Green',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Mason Black',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Ava White',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Liam Blue',
                'contact_number' => '09550090156'
            ],
            [
                'name' => 'Olivia Yellow',
                'contact_number' => '09550090156'
            ]
        ]);
    }
}
