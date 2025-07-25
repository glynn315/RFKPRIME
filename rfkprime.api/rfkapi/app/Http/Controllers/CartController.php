<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function displayCart()
    {
        $display = Cart::all();

        return response()->json($display);
    }

    public function addCart(Request $request)
    {
        $currentDateReference = date("Ymd");
        $countValue = Cart::where('cart_status', '=', 'COMPLETE')->distinct()->count('*');

        $cart_info = $request->validate([
            'product_id' => 'string|required',
            'quantity' => 'integer|required',
            'cart_status' => 'string|required',
            'product_price' => 'integer|required',
        ]);

        $cart_info['cart_id'] = 'CRT-' . $currentDateReference .'-'. $countValue;

        return Cart::create($cart_info);
    }
}
