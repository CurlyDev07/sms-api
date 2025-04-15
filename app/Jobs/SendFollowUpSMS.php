<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendFollowUpSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function handle(): void
    {
        // Simulate sending SMS
        Log::info("Sending SMS to {$this->event->contact_number}: {$this->event->message}");

        // Update event status
        $this->event->status = 'sent';
        $this->event->save();
    }
}