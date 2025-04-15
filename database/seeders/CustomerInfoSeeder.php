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
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime, // Now
            ],
            [
                'name' => 'Jane Smith',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(1), // 1 minute later
            ],
            [
                'name' => 'Mark Johnson',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(2), // 2 minutes later
            ],
            [
                'name' => 'Emily Davis',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(3), // 3 minutes later
            ],
            [
                'name' => 'Lucas White',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(4), // 4 minutes later
            ],
            [
                'name' => 'Sophia Brown',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(5), // 5 minutes later
            ],
            [
                'name' => 'Isabella Green',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(6), // 6 minutes later
            ],
            [
                'name' => 'Mason Black',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(7), // 7 minutes later
            ],
            [
                'name' => 'Ava White',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(8), // 8 minutes later
            ],
            [
                'name' => 'Liam Blue',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(9), // 9 minutes later
            ],
            [
                'name' => 'Olivia Yellow',
                'contact_number' => '09550090156',
                'order_created_at' => $currentTime->addMinutes(10), // 10 minutes later
            ]
        ]);
    }
}
