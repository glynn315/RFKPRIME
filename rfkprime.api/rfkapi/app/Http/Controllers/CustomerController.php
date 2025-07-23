<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function displayList(){
        $customer = Customer::all();

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
}
