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
      // Call the SmsService to send the message
      $smsService = new SmsService();
      $smsService->infoTextSend($request->contact_number, $request->message);

      return response()->json([
          'message' => 'SMS sent successfully!'
      ]);
    }
}
