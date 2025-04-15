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

Route::get('/', function () {


    $sms_data = [
        'UserID' => '669',
        'ApiKey' => '207bb08817f8ab47ac813b6b8917de0d',
        'Mobile' => '09550090156',
        'SMS' => 'sms-api test',
    ];
    
    curl_req('https://api.myinfotxt.com/v2/send.php', $sms_data);





    return view('welcome');
});


