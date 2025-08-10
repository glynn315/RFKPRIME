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

    public function updateQuantity(Request $request)
    {
        foreach ($request->cart_items as $item) {
            $product = Product::where('product_id', $item['product_id'])->first();

            if ($product) {
                $product->product_quantity -= $item['quantity'];
                if ($product->product_quantity < 0) {
                    $product->product_quantity = 0; // prevent negative stock
                }
                $product->save();
            }
        }

        return response()->json(['message' => 'Product quantities updated successfully']);
    }
public function inventoryList()
{
    $products = \DB::table('products as p')
        ->leftJoin('carts as c', 'p.product_id', '=', 'c.product_id')
        ->select(
            'p.product_id',
            'p.product_name',
            'p.product_quantity as remaining_quantity',
            \DB::raw('COALESCE(SUM(c.quantity), 0) as total_sold')
        )
        ->groupBy('p.product_id', 'p.product_name', 'p.product_quantity')
        ->get();

    return response()->json($products); // This will return [] if no products
}






}
