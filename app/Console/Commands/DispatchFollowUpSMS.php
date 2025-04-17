<?php

namespace App\Console\Commands;

use App\Services\SmsService;
use Illuminate\Console\Command;
use App\Models\CustomerInfo;
use App\Models\Event;
use App\Models\CustomerFollowUp;
use App\Jobs\SendFollowUpSMS;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;  // <-- Add this line

class DispatchFollowUpSMS extends Command
{
    protected $signature = 'sms:dispatch';
    protected $description = 'Dispatch follow-up SMS based on sms message interval';

    public function handle()
    {
        // $response = infoTextSend('09550090156', 'putang ina its working');
        // $this->info('Test SMS sent!');
// ==============================================================
        
        // $followUps = CustomerFollowUp::with(['customerInfo', 'smsMessage'])->where('status', 'pending')->get();

        // foreach ($followUps as $followUp) {
        //     $createdAt = Carbon::parse($followUp->created_at);
        //     $now = Carbon::now();
        //     $minutesPassed = $createdAt->diffInMinutes($now);
        
        //     $interval = $followUp->smsMessage->interval;
        
        //     echo "Minutes passed: {$minutesPassed} | Interval: {$interval}\n";
        
        //     // Optional: Check if it’s time to send the SMS
        //     if ($minutesPassed >= $interval) {
        //         echo "✅ Time to send SMS to {$followUp->contact_number}\n";
        //     }
        // }



// ==============================================================


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
    
        $this->info('Follow-up SMS jobs dispatched!');
    }
    
}
