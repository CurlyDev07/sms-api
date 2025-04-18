<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SmsController;

Route::post('/create-customer-info', [SmsController::class, 'create_customer_info']);
Route::post('/create-sms-message', [SmsController::class, 'create_sms_message']);
Route::get('/get-sms-message', [SmsController::class, 'get_sms_message']);
Route::get('/get-customer-follow-up', [SmsController::class, 'get_customer_follow_up']);




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


