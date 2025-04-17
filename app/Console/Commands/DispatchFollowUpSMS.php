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
        $followUps = CustomerFollowUp::with(['customerInfo', 'smsMessage'])->where('status', 'pending')->get();
        
        foreach ($followUps as $followUp) {
            $createdAt = Carbon::parse($followUp->created_at);
            $intervalHours = $followUp->smsMessage->interval;
        
            $scheduledTime = $createdAt->addHours($intervalHours);
            $now = Carbon::now();
        
            $diffInHours = $now->diffInHours($scheduledTime, false); // optional, if you need it
        
            if ($now->greaterThanOrEqualTo($scheduledTime)) {
                dispatch(new SendFollowUpSMS($followUp->id));
            }
        }
    
        $this->info('Follow-up SMS jobs dispatched!');
    }
    
}
