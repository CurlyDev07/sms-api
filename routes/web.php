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
    dd($followUps);
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

            if ($response->status == "00") {
                $followUp->status = "sent";
            }

        }
    }

    return view('welcome');
});


