<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SmsService;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    public function sendSms(Request $request)
    {
        // Validate the request
        // $validator = Validator::make($request->all(), [
        //     'contact_number' => 'required|digits:11',  // Ensure the number is 11 digits (for Philippine numbers)
        //     'message' => 'required|string|max:160',    // Validate the message is a string with max 160 characters
        // ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Call the SmsService to send the message
        $smsService = new SmsService();
        $smsService->infoTextSend($request->contact_number, $request->message);

        return response()->json([
            'message' => 'SMS sent successfully!'
        ]);
    }
}
