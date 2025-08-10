<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function displayList(){
        $product = Orders::all();

        return response()->json($product);
    }

    public function DisplayUser($id){
        $order = Orders::with('customer')->where('order_id','=', $id)->firstOrFail();

        $customer = $order->customer;

        return response()->json([
            'first_name' => $customer?->customer_fname,
            'middle_name' => $customer?->customer_mname,
            'last_name' => $customer?->customer_lname,
            'contact_number' => $customer?->contact_number,
            'contact_person' => $customer?->contact_person,
            'province' => $customer?->customer_province,
            'city' => $customer?->customer_city,
        ]);
    }

    public function addOrders(Request $request){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'payment_method' => 'string|required',
            'terms' => 'integer',
            'percentage' => 'integer',
            'cart_id' => 'string|required',
        ]);

        $validatedData['order_id'] = Str::uuid()->toString();
        return Orders::create($validatedData);
    }
}
