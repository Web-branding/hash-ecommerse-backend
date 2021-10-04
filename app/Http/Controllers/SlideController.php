<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Exception;
use App\Models\Wishlist;
use App\Models\Cart;

class SlideController extends Controller
{
    public function index() {
        $slides = Slide::get()->all();
        return view('slides.slide', compact('slides'));
    }
    public function slideadd() {
        return view('slides.add_slide');
    }
    public function add_slide(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required',
        ]); 
        
        $filename = time().'.'.$request->file('file')->getClientOriginalName();
        $request->file('file')->move(storage_path('app/public/slides'), $filename);   

        $data=new Slide();
        $data->title=$request->title;
        $data->description=$request->description;
        $data->file=$filename;
        $data->save();
        return redirect()->route('add.slide')->with('add', 'Slide added successfully!');     
    }
    public function destroy_slide(Request $request, Slide $slide) {
        $id = $request->delete_id;
        $slide->find($id)->delete();
        return redirect()->route('slides.view')->with('delete', 'Slide deleted successfully.');
    }
    public function slide() {
        $slides = Slide::get()->all();

        foreach($slides as $slide)
        {
            $image[] = asset('storage/slides/' . $slide->file);   
        }
        
        return response()->json([
            $slides,
            'image' => $image,
            'status' => 200,
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:10',
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $filename = time().'.'.$request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path('profile'), $filename); 

        $user = User::create([
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'file' => $filename,
            'image_path' => asset('profile/'.$filename),
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'message' => "User registered successfully",
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Bad Request'
            ]);
        }
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Unauthorized'
            ]);
        }
       
        // $user = User::where('email', $request->email)->first();
        $user = User::where('email', $request->email)->where('utype', 'USR')->first();

        if($user)
        {
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'token' => $tokenResult,
                'token_type' => 'Bearer',
                'message' => 'logged in successfully'
            ]);
        }
        else
        {
            return response()->json([
                'status_code' => 200,
                'message' => 'Unauthenticated'
            ]);
        }
    }

    public function profile(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'token' => 'Token deleted successfully!'
        ]);
    }

    public function search($name)
    {
        $autodata =  Product::select("name")
        ->where("name","LIKE","%{$name}%")
        ->get();
        $data =  Product::where('name', $name)->get();
        return response()->json([
            'status_code' => 200,
            'data' => $data,
            'autodata' => $autodata
        ]);
    }
    public function sort(Request $request)
    {
        $sort = $request->sort;
        if($sort == 'low to high')
        {
            $product = Product::orderBy('price', 'ASC')->get();
        }
        if($sort == 'high to low')
        {
            $product = Product::orderBy('price', 'DESC')->get();
        }

        return response()->json([
            'status_code' => 200,
            'data' => $product
        ]);
    }

    public function add_wishlist(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $user = $request->user();
        Wishlist::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'email' => $user->email,
        ]);

        return response()->json([
            'status_code' => '200',
            'message' => "Wishlist added successfully",
        ]);
    }

    public function wishlist(Request $request)
    {
        $user = $request->user();
        $wishlist = Wishlist::where('email', $user->email)->get()->all();
        return response()->json([
            'status_code' => '200',
            'data' => $wishlist,
        ]);
    }

    public function cart(Request $request)
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'product' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        Cart::create([
            'email' => $user->email,
            'product' => $validatedData['product'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
        ]);

        return response()->json([
            'status_code' => '200',
            'message' => 'Product added to your cart successfully!',
        ]);
    }

    public function cart_list(Request $request)
    {
        $user = $request->user();
        $cart = Cart::where('email', $user->email)->get()->all();

        return response()->json([
            'status_code' => '200',
            'data' => $cart,
        ]);
    }
    
    public function order_list(Request $request)
    {
        $user = $request->user();
        $order = Cart::where('email', $user->email)->get()->all();

        return response()->json([
            'status_code' => '200',
            'data' => $order,
        ]);
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

        // return redirect()->route('home');
        return "hai";
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
    }
}
