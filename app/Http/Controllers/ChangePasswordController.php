<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function index() {
        return view('auth.passwords.change');
    }
    
    public function changePassword(Request $request) {
        // return $request->all();
        $this->validate($request, [
            'oldpassword' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        // return $hashedPassword;
        if(Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
        return redirect()->route('index')->with('success', 'Password has been updated successfully!');
        }
        else {
            return redirect()->back()->with('error', 'Current Password is not valid.');
        }
    }

    public function userpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Bad Request'
            ]);
        }

        $hashedPassword = Auth::user()->password;
       
        if(Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'status_code' => 200,
                'message' => 'Password has been updated successfully!'
            ]);
        }
        else {
            return response()->json([
                'status_code' => 200,
                'message' => 'Current Password is not valid.'
            ]);
        }
    }
    
}
