<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomerInfo;
use App\Models\Event;
use App\Jobs\SendFollowUpSMS;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;  // <-- Add this line

class DispatchFollowUpSMS extends Command
{
    protected $signature = 'sms:dispatch';
    protected $description = 'Dispatch follow-up SMS based on events and order dates';

    public function handle()
    {
        $now = Carbon::now();

        $customers = CustomerInfo::all();

        foreach ($customers as $customer) {
            $daysSinceOrder = $customer->created_at->diffInDays($now);

            // Get all pending events for this contact number where days_interval matches
            $events = Event::where('contact_number', $customer->contact_number)
                ->where('status', 'pending')
                ->where('days_interval', $daysSinceOrder)
                ->get();

            foreach ($events as $event) {
                SendFollowUpSMS::dispatch($event);
            }

            // Log if no event found
            if ($events->isEmpty()) {
                Log::info("No event found for contact number {$customer->contact_number}");
            }
        }

        $this->info('Follow-up SMS jobs dispatched!');
    }
}
