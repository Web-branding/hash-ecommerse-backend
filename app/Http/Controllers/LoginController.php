<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function home()
    {
        return view('home');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->utype == 'ADM') {
                return redirect()->route('home');
            }else{
                return redirect()->route('index')->with('error', 'Invalid Credentials');
            }
        }
        else{
            return redirect()->route('index')->with('error', 'Invalid Credentials');
        }
          
    }

    public function logout(Request $request) {
        Auth::logout();
        return view('auth.login');
    }


     // google login
     public function redirectToGoogle()
     {
         return Socialite::driver('google')->redirect();
     }
 
     public function handleGoogleCallback()
     {
         $user = Socialite::driver('google')->user();
 
         $this->_registerOrLoginUser($user);
 
        //  return redirect()->route('home');
     }

     protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->google_id = $data->id;
            $user->save();
        }

        Auth::login($user);
        // $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'status_code' => 200,
            // 'token' => $tokenResult,
            'token_type' => 'Bearer',
            'message' => 'logged in successfully'
        ]);
    }
}
