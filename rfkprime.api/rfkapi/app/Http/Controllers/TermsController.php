<?php

namespace App\Http\Controllers;

use App\Models\Terms;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function displayTerms(){
        $paymentterms = Terms::all();
        return response()->json($paymentterms);
    }

    public function addPaymentterms(Request $request){
        $request->validate([
            'amount' => 'decimal:2 | required',
            'initial_date' => 'required|date',
            'terms' => 'required|integer|min:1|max:12',
            'payment_id' => 'required',
        ]);

        $startDate = Carbon::parse($request->initial_date);
        $terms = (int) $request->terms;
        $paymentId = $request->payment_id;
        $amount = $request->amount;

        for ($i = 1; $i <= $terms; $i++) {
            $scheduleDate = $startDate->copy()->addMonths($i);
            
            Terms::create([
                'amount' => $amount,
                'schedule_date' => $scheduleDate->toDateString(),
                'payment_date' => null,
                'payment_status' => 'PENDING',
                'payment_id' => $paymentId,
            ]);
        }

        return response()->json(['message' => 'Payment terms created successfully']);
    }
}
