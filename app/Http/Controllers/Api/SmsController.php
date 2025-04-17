<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function customer_info(Request $request){
        $request->validate([
            'name' => 'required|string',
            'contact_number' => 'required|string',
        ]);
    
        $customer = CustomerInfo::create($request->only('name', 'contact_number'));
    }
}
