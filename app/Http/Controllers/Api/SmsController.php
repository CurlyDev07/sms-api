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

        foreach ($messages as $follow_up_message) {
            CustomerFollowup::create([
                'customer_info_id' => $customer->id,
                'sms_message_id' => $follow_up_message->id,
            ]);
        }

        return response()->json([
            'message' => 'customer info created successfully!',
            'sms_message' => $customer
        ], 201);
    }
    
    public function create_sms_message(Request $request){
        $validatedData = $request->validate([
            'message_name' => 'required|string|max:255',
            'message' => 'required|string',
            'interval' => 'required|integer',
        ]);

        $smsMessage = SmsMessage::create([
            'message_name' => $validatedData['message_name'],
            'message' => $validatedData['message'],
            'interval' => $validatedData['interval'],
        ]);

        return response()->json([
            'message' => 'SMS message created successfully!',
            'sms_message' => $smsMessage
        ], 201);
    }

    public function get_sms_message(){
        $messages = SmsMessage::get();

        return response()->json([
            'status' => 'success',
            'data' => $messages
        ]);
    }

    public function get_customer_follow_up(){
        $followUps = CustomerFollowUp::with(['customerInfo', 'smsMessage'])->get();

        $data = $followUps->map(function ($followUp) {
            return [
                'name' => $followUp->customerInfo->name,
                'contact_number' => $followUp->customerInfo->contact_number,
                'message_name' => $followUp->smsMessage->message_name,
                'interval' => $followUp->smsMessage->interval,
                'status' => $followUp->status,
            ];
        });
    
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }



}
