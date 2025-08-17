<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function displayList(){
        $customer = Customer::where('customer_status' , 'ACTIVE')->get();

        return response()->json($customer);
    }

    public function addCustomer(Request $request){
        $validatedData = $request->validate([
            'customer_fname' => 'string|required',
            'customer_lname' => 'string|required',
            'customer_mname' => 'string',
            'contact_person' => 'string|required',
            'contact_number' => 'string|required',
            'customer_province' => 'string|required',
            'customer_city' => 'string|required',
            'customer_zip' => 'integer|required',
            'customer_status' => 'string|required',
        ]);

        $validatedData['customer_id'] = Str::uuid()->toString();
        return Customer::create($validatedData);
    }

    public function updateCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validatedData = $request->validate([
            'customer_fname' => 'string|required',
            'customer_lname' => 'string|required',
            'customer_mname' => 'string|nullable',
            'contact_person' => 'string|required',
            'contact_number' => 'string|required',
            'customer_province' => 'string|required',
            'customer_city' => 'string|required',
            'customer_zip' => 'integer|required',
            'customer_status' => 'string|required',
        ]);

        $customer->update($validatedData);

        return response()->json([
            'message' => 'Customer updated successfully',
            'customer' => $customer
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'customer_status' => 'required|string'
        ]);

        $customer = Customer::findOrFail($id);
        $customer->customer_status = $request->customer_status;
        $customer->save();

        return response()->json([
            'message' => 'Customer status updated successfully',
            'customer' => $customer
        ]);
    }

}
