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

    public function displayTermsListPerCustomer(){
        $earliestTerms = Terms::select('*')
        ->where('payment_status', 'PENDING')
        ->whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('terms')
                ->where('payment_status', 'PENDING')
                ->groupBy('order_id');
        })
        ->get();

    return response()->json($earliestTerms);
    }

    public function PaymentListPerCustomer($orderID){
        $displayList = Terms::where('order_id', '=' , $orderID)
        ->get();

        return response()->json($displayList);
    }
    public function displayTermInformation($id){
        $displayTermsInformation = Terms::where('id', '=' , $id)
        ->where('payment_status' , '=' , 'PENDING')
        ->first();

        return response()->json($displayTermsInformation);
    }

    public function addPaymentterms(Request $request){
        $request->validate([
            'amount' => 'decimal:2 | required',
            'initial_date' => 'required|date',
            'terms' => 'required|integer|min:1|max:12',
            'order_id' => 'required',
        ]);

        $startDate = Carbon::parse($request->initial_date);
        $terms = (int) $request->terms;
        $paymentId = $request->order_id;
        $amount = $request->amount;

        for ($i = 1; $i <= $terms; $i++) {
            $scheduleDate = $startDate->copy()->addMonths($i);
            
            Terms::create([
                'amount' => $amount,
                'schedule_date' => $scheduleDate->toDateString(),
                'payment_date' => null,
                'payment_status' => 'PENDING',
                'order_id' => $paymentId,
            ]);
        }

        return response()->json(['message' => 'Payment terms created successfully']);
    }
    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|string|in:PENDING,PAID',
            'payment_date' => 'nullable|date'
        ]);

        $term = Terms::findOrFail($id);
        $term->payment_status = $request->payment_status;
        $term->payment_date = date("Y-m-d");
        $term->save();

        return response()->json([
            'message' => 'Payment status updated successfully.',
            'data' => $term
        ]);
    }
}
