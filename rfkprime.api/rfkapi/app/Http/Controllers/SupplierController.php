<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function displayList(){
        $supplier = Supplier::where('supplier_status', 'ACTIVE')->get();
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

    public function updateSupplier(Request $request, $id){
        $supplier = Supplier::findOrFail($id);

        $validatedData = $request->validate([
            'supplier_name' => 'string|required',
            'brand_name' => 'string|required',
            'supplier_status' => 'string|required',
        ]);

        $supplier->update($validatedData);

        return response()->json(['message' => 'Supplier updated successfully']);
    }

    public function removeSupplier($id){
        $supplier = Supplier::findOrFail($id);
        $supplier->update(['supplier_status' => 'REMOVED']);

        return response()->json(['message' => 'Supplier removed successfully']);
    }
}
