<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Models\CustomerFollowUp;
use Illuminate\Support\Carbon;

Route::get('/', function () {

    $followUps = CustomerFollowUp::with(['customerInfo', 'smsMessage'])->where('status', 'pending')->get();
    echo count($followUps);
    foreach ($followUps as $followUp) {
        $createdAt = Carbon::parse($followUp->created_at);
        $intervalMinutes = $followUp->smsMessage->interval;
    
        $scheduledTime = $createdAt->addMinutes($intervalMinutes);
        $now = Carbon::now();

        $diffInMinutes = $now->diffInMinutes($scheduledTime, false); // Use false for absolute difference


        if ($now->greaterThanOrEqualTo($scheduledTime)) {
        //    It's time to send SMS

            $contact_number = $followUp->customerInfo->contact_number;
            $message = $followUp->smsMessage->message;

            $response = infoTextSend($contact_number, $message);

              // Decode JSON string to object if it's a string
            if (is_string($response)) {
                $response = json_decode($response);
            }

            // Check if $response is an object and has 'status' property
            if (is_object($response) && isset($response->status)) {
                if ($response->status == "00") {
                    $followUp->status = "sent";
                    $followUp->save(); // Save the updated status to the database
                }
            } else {
                // Handle unexpected response structure (log or handle accordingly)
                echo 'error';
            }
        }
    }

    return view('welcome');
});


