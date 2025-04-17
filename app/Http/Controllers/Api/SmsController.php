<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerFollowUp;
use App\Models\SmsMessage;
use App\Models\CustomerInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function create_customer_info(Request $request){
        $request->validate([
            'name' => 'required|string',
            'contact_number' => 'required|string',
        ]);
    
        $customer = CustomerInfo::create($request->only('name', 'contact_number'));

        $messages = SmsMessage::all();

        return response()->json($messages);


        // CustomerFollowup::create([
        //     'name' => $request->name,
        //     'contact_number' => $request->contact_number,
        //     'sms_message_id' => 1, // Make sure this ID exists in sms_messages
        //     'interval' => 3,
        // ]);

        return response()->json([
            'message' => 'customer info created successfully!',
            'sms_message' => $customer
        ], 201);
    }
    
    public function create_sms_message(Request $request){
        $validatedData = $request->validate([
            'message_name' => 'required|string|max:255',
            'message' => 'required|string',
            'contact_number' => 'required|string|max:15',
            'interval' => 'required|integer',
        ]);

        $smsMessage = SmsMessage::create([
            'message_name' => $validatedData['message_name'],
            'message' => $validatedData['message'],
            'contact_number' => $validatedData['contact_number'],
            'interval' => $validatedData['interval'],
        ]);

        return response()->json([
            'message' => 'SMS message created successfully!',
            'sms_message' => $smsMessage
        ], 201);
    }



}
