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
        $now = Carbon::now();
        $minutesPassed = $createdAt->diffInMinutes($now);
    
        $interval = $followUp->smsMessage->interval;
    
        echo "Minutes passed: {$minutesPassed} | Interval: {$interval}\n";
    
        // Optional: Check if it’s time to send the SMS
        if ($minutesPassed >= $interval) {
            echo "✅ Time to send SMS to {$followUp->contact_number}\n";
        }
    }


    return view('welcome');
});


