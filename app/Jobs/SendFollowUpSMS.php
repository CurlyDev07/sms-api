<?php

namespace App\Jobs;

use App\Services\SmsService;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendFollowUpSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;

    // Inject the SmsService
    protected $smsService;

    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->smsService = new SmsService(); // Instantiate SmsService
    }

    public function handle(): void
    {
        // Send SMS using SmsService
        $response = $this->smsService->infoTextSend($this->event->contact_number, $this->event->message);

        // Check if the SMS was sent successfully (you can modify based on API response)
        if ($response['status'] == 'success') {
            // Update event status to 'sent' if the SMS was successful
            $this->event->status = 'sent';
            $this->event->save();

            Log::info("SMS sent successfully to {$this->event->contact_number}: {$this->event->message}");
        } else {
            // Handle failure (you can modify this based on actual API error response)
            Log::error("Failed to send SMS to {$this->event->contact_number}: {$this->event->message}");
            $this->event->status = 'failed';
            $this->event->save();
        }
    }
}
