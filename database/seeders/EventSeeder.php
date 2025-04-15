<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'sms_name' => 'Welcome Message',
                'message' => 'Welcome to our service!',
                'contact_number' => '09550090156',
                'days_interval' => 1,
                'status' => 'pending',
            ],
            [
                'sms_name' => 'Follow-Up Message',
                'message' => 'Just checking in to see how things are going.',
                'contact_number' => '09550090156',
                'days_interval' => 1,
                'status' => 'pending',
            ],
            [
                'sms_name' => 'Reminder Message',
                'message' => 'Don\'t forget about our upcoming event!',
                'contact_number' => '09550090156',
                'days_interval' => 2,
                'status' => 'pending',
            ],
            [
                'sms_name' => 'Reminder Message',
                'message' => 'Don\'t forget about our upcoming event!',
                'contact_number' => '09550090156',
                'days_interval' => 3,
                'status' => 'pending',
            ],
            // Add more messages as needed
        ]);
    }

}
