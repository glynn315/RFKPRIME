<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function displayPayment(){
        $paymentList = Payment::all();

        return response()->json($paymentList);
    }

    public function storePayment(Request $request){
        $paymentData = $request->validate([
            'payment_amount' => 'decimal:2',
            'payment_status' => 'string|required',
            'order_id' => 'string | required',
        ]);
        return Payment::create($paymentData);
    }
}
