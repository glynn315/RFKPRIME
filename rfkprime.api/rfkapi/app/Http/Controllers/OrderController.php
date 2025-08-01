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
