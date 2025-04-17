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

    foreach ($followUps as $followUp) {
        $createdAt = Carbon::parse($followUp->created_at);
        $intervalMinutes = $followUp->smsMessage->interval;
    
        $scheduledTime = $createdAt->addMinutes($intervalMinutes);
        $now = Carbon::now();

        $diffInMinutes = $now->diffInMinutes($scheduledTime, false); // Use false for absolute difference

        echo " {$diffInMinutes}\n <br>'";


        // if ($now->greaterThanOrEqualTo($scheduledTime)) {
        //     echo "✅ Time to send SMS to {$scheduledTime}\n <br>'";
        //     echo "{$followUp->smsMessage->message_name}\n <br>'";
        //     echo "{$followUp->smsMessage->message}\n <br>'";
        //     echo "{$followUp->smsMessage->interval}\n <br>'";
        //     echo "<hr>";
        //     echo "{$followUp->customerInfo->name}\n <br>'";
        //     echo "{$followUp->customerInfo->contact_number}\n <br>'";
        //     echo '<br>';
        //     // You can now trigger SMS or mark as sent
        // } else {
        //     echo "⏳ Not yet time for {$followUp->contact_number}\n <br>'";
        //     echo '<br>';
        // }
    }


    return view('welcome');
});


