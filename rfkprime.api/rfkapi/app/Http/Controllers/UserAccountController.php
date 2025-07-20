<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserAccountController extends Controller
{
    public function displayList(){
        $userAccount = UserAccount::all();

        return response()->json($userAccount);
    }

    public function addUser(Request $request){
        $validatedData = $request->validate([
            'user_fname' => 'string|required',
            'user_mname' => 'string|required',
            'user_lname' => 'string|required',
            'user_province' => 'string|required',
            'user_city' => 'string|required',
            'user_zip' => 'string|required',
            'user_status' => 'string|required',
            'user_username' => 'string|required',
            'user_password' => 'string|required',
        ]);

        $validatedData['user_id'] = Str::uuid()->toString();
        $validatedData['user_password'] = bcrypt($validatedData['user_password']);

        return UserAccount::create($validatedData);
    }
}
