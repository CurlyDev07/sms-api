<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    protected $smsService;

    // Inject SmsService through constructor
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Send an SMS to a customer.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendSms(Request $request)
    {

        // Send SMS using the SmsService
        $response = $this->smsService->infoTextSend($validated['contact_number'], $validated['message']);

        // Check the response and return a success/failure message
        if (isset($response['status']) && $response['status'] === 'success') {
            return response()->json(['message' => 'SMS sent successfully!']);
        }

        return response()->json(['message' => 'Failed to send SMS.'], 500);
    }
}
