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
            'user_zip' => 'integer|required',
            'user_status' => 'string|required',
            'user_username' => 'string|required',
            'user_password' => 'string|required',
            'userRole' => 'string|required'
        ]);

        $validatedData['user_id'] = Str::uuid()->toString();
        $validatedData['user_password'] = bcrypt($validatedData['user_password']);

        return UserAccount::create($validatedData);
    }

    public function updateUser(Request $request, $id){
        $user = UserAccount::findOrFail($id);

        $validatedData = $request->validate([
            'user_fname' => 'string|required',
            'user_mname' => 'string|required',
            'user_lname' => 'string|required',
            'user_province' => 'string|required',
            'user_city' => 'string|required',
            'user_zip' => 'integer|required',
            'user_status' => 'string|required',
            'user_username' => 'string|required',
            'user_password' => 'nullable|string',
            'userRole' => 'string|required'
        ]);

        // If password is provided, hash it
        if(!empty($validatedData['user_password'])){
            $validatedData['user_password'] = bcrypt($validatedData['user_password']);
        } else {
            unset($validatedData['user_password']);
        }

        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully']);
    }

    // 🔹 Soft Remove User (set status to REMOVED)
    public function removeUser($id){
        $user = UserAccount::findOrFail($id);
        $user->update(['user_status' => 'REMOVED']);

        return response()->json(['message' => 'User removed successfully']);
    }
}
