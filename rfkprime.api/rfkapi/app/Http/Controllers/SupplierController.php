<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function displayList(){
        $supplier = Supplier::all();

        return response()->json($supplier);
    }

    public function addSupplier(Request $request){
        $validatedData = $request->validate([
            'supplier_name' => 'string|required',
            'brand_name' => 'string|required',
            'supplier_status' => 'string|required',
        ]);

        $validatedData['supplier_id'] = Str::uuid()->toString();
        return Supplier::create($validatedData);
    }
}
