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
            'cart_id' => 'string|required',
            'payment_method' => 'string|required',
            'payment_amount' => 'integer',
            'payment_status' => 'string|required',
        ]);

        $paymentData['payment_id'] = Str::uuid()->toString();

        return Payment::create($paymentData);
    }
}
