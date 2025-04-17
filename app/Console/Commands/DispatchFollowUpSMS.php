<?php

namespace App\Console\Commands;

use App\Services\SmsService;
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
        
        $now = Carbon::now()->toDateTimeString();

        $smsService = new SmsService(); // or however you're calling your SMS API
        $response = $smsService->infoTextSend("09550090156", 'Test SMS sent every minute — ' . $now);
        
        $this->info(print_r($response, true));

        $this->info('Test SMS sent!');


    
        // $customers = CustomerInfo::all();
    
        // $this->info("Found " . $customers->count() . " customers.");
    
        // foreach ($customers as $customer) {
        //     $daysSinceOrder = $customer->created_at->diffInDays($now);
    
        //     // Get all pending events for this contact number where days_interval matches
        //     $events = Event::where('contact_number', $customer->contact_number)
        //         ->where('status', 'pending')
        //         ->where('days_interval', $daysSinceOrder)
        //         ->get();
    
        //     $this->info("Found " . $events->count() . " events for contact number {$customer->contact_number}");
    
        //     foreach ($events as $event) {
        //         SendFollowUpSMS::dispatch($event);
        //     }
    
        //     if ($events->isEmpty()) {
        //         Log::info("No event found for contact number {$customer->contact_number}");
        //     }
        // }
    
        // $this->info('Follow-up SMS jobs dispatched!');
    }
    
}
