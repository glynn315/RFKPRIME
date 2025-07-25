<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function displayList(){
        $product = Product::all();

        return response()->json($product);
    }

    public function displaySeelctedbyId($id){
        $product = Product::where('product_id', '=' , $id)->first();

        return response()->json($product);
    }

    public function addProduct(Request $request){
        $validatedData = $request->validate([
            'supplier_id' => 'required',
            'product_name' => 'string|required',
            'product_volume' => 'string|required',
            'product_quantity' => 'string|required',
            'product_pricepc' => 'integer|required',
            'product_pricebulk' => 'integer|required',
            'product_status' => 'string|required',
        ]);

        $validatedData['product_id'] = Str::uuid()->toString();
        return Product::create($validatedData);
    }
}
