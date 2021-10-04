<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Stripe;
use App\Helpers\Helper;
use App\Models\Order;
use App\Models\Orderitems;
use App\Models\Cart;
use App\Models\Shipping;
use App\Mail\ConfirmationMail;
use Mail;
use Razorpay\Api\Api;
use Session;
use PDF;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

use App\Models\Payment;
use Redirect;

class TransactionController extends Controller
{
    public function payment(Request $request)
    {
        $user = $request->user();
        $cart = Cart::where('email', $user->email)->get()->all();

        $validatedData = $request->validate([
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required|numeric',
            'payment_mode' => 'required',
            'shipping_different' => 'required',
        ]);

        $order_id = Helper::IDGenerator(new Order, 'order_id', 4, 'OD');

        $order = new Order();
        $order->order_id = $order_id;
        $order->fname = $user->fname;
        $order->lname = $user->lname;
        $order->email = $user->email;
        $order->phone = $user->phone;
        $order->address = $validatedData['address'];
        $order->city = $validatedData['city'];
        $order->state = $validatedData['state'];
        $order->country = $validatedData['country'];
        $order->zip = $validatedData['zip'];
        $order->payment_mode = $validatedData['payment_mode'];
        $order->shipping_different = $validatedData['shipping_different'];
        $order->status = 'Ordered';
        $order->save();

        foreach($cart as $items)
        {
            $orderitems = new Orderitems();
            $orderitems->order_id = $order_id;
            $orderitems->email = $items->email;
            $orderitems->product = $items->product;
            $orderitems->price = $items->price;
            $orderitems->quantity = $items->quantity;
            $orderitems->total_price = $items->price*$items->quantity;
            $orderitems->save();
        }
        
        if($validatedData['shipping_different'] == 'same')
        {
            $shipping = new Shipping();
            $shipping->order_id = $order_id;
            $shipping->fname = $user->fname;
            $shipping->lname = $user->lname;
            $shipping->email = $user->email;
            $shipping->phone = $user->phone;
            $shipping->address = $validatedData['address'];
            $shipping->city = $validatedData['city'];
            $shipping->state = $validatedData['state'];
            $shipping->country = $validatedData['country'];
            $shipping->zip = $validatedData['zip'];
            $shipping->save();
        }
        else
        {
            $shipping = new Shipping();
            $shipping->order_id = $order_id;
            $shipping->fname = $request->fname_diff;
            $shipping->lname = $request->lname_diff;
            $shipping->email = $request->email_diff;
            $shipping->phone = $request->phone_diff;
            $shipping->address = $request->address_diff;
            $shipping->city = $request->city_diff;
            $shipping->state = $request->state_diff;
            $shipping->country = $request->country_diff;
            $shipping->zip = $request->zip_diff;
            $shipping->save();
        }

        if($validatedData['payment_mode'] == 'cod')
        {
            $transaction = new Transaction();
            $transaction->order_id = $order_id;
            $transaction->payment_mode = 'COD';
            $transaction->status = 'Pending';
            $transaction->save();
        }

        $total_price = Orderitems::where('order_id', $order_id)->sum('total_price');

        foreach($cart as $item)
        {
            $details = [
                'fname' => $user->fname,
                'lname' => $user->lname,
                'product' => $item->product,
                'order_id' => $item->order_id,
                'address' => $validatedData['address'],
                'city' => $validatedData['city'],
                'state' => $validatedData['state'],
                'zip' => $validatedData['zip'],
                'phone' => $user->phone,
                'total_price' => $total_price,
                'order_id' => $order_id,
            ];
        }

        Mail::to($user->email)->send(new ConfirmationMail($details));

        





        if($validatedData['payment_mode'] == 'card')
        {

            // $validatedData = $request->validate([
            //     'razorpay_payment_id' => 'required|numeric',
            // ]);

            $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

            $payment = $api->payment->fetch($order_id);

            if(!empty($order_id)) {
                try {
                    $response = $api->payment->fetch($order_id)->capture(array('amount'=>$total_price)); 

                } catch (\Exception $e) {
                    // return  $e->getMessage();
                    \Session::put('error',$e->getMessage());
                    // return redirect()->back();
                }
            }
        
            \Session::put('success', 'Payment successful');
            // return redirect()->back();



            // stripe
            // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            // Stripe\Charge::create ([
            //         "amount" => 100 * 100,
            //         "currency" => "usd",
            //         "source" => $request->stripeToken,
            //         "description" => "Test payment from itsolutionstuff.com." 
            // ]);


        }



        // Cart::where('email', $user->email)->delete();
       
        return response()->json([
            'status_code' => '200',
            'message' => 'Thank you for your order. Confirmation email has been sent to your email address.',
        ]);

        // return response()->json([
        //     'status_code' => '200',
        //     'message' => $request->all(),
        // ]);
    }

    
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from tutsmake.com."
        ]);
   
           
        return response()->json([
            'status_code' => '200',
            'message' => 'Payment successful!',
        ]);
    }

    // admin order download
    public function getAllOrders()
    {
        $orders = Order::all();
        return view('order.allorders', compact('orders'));
    }

    public function downloadPDF()
    {   
        $orders = Order::all();
        $pdf = PDF::loadView('order.allorders', compact('orders'));
        return $pdf->download('orders.pdf');
    }
    // user order history download
    public function downloadSingleUser(Request $request)
    {
        $user = $request->user();
        $orders = Order::where('email', $user->email)->get()->all();
        $orderitems = Orderitems::where('email', $user->email)->get()->all();
        $pdf = PDF::loadView('order.singleuserorders', compact('orders'), compact('orderitems'));
        return $pdf->download('orderhistory.pdf');
    }
    // user single order download
    public function downloadSingleOrder(Request $request,$order_id)
    {
        $user = $request->user();
        $orders = Order::where('email', $user->email)->where('order_id', $order_id)->get()->all();
        $orderitems = Orderitems::where('email', $user->email)->where('order_id', $order_id)->get()->all();
        $pdf = PDF::loadView('order.singleorders', compact('orders'), compact('orderitems'));
        return $pdf->download('orderhistory.pdf');
    }



    public function payWithRazorpay()
    {        
        return view('payWithRazorpay');
    }

    public function paymenttt(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {

                $payment->capture(array('amount'=>$payment['amount']));

            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }

        $payInfo = [
                   'payment_id' => $request->razorpay_payment_id,
                   'user_id' => '1',
                   'amount' => $request->amount,
                ];
                
        Payment::insertGetId($payInfo);  
        
        \Session::put('success', 'Payment successful');

        return response()->json(['success' => 'Payment successful']);
    }

    public function paymentt(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {

                $payment->capture(array('amount'=>$payment['amount']));

            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }

        $payInfo = [
                   'payment_id' => $request->razorpay_payment_id,
                   'user_id' => '1',
                   'amount' => $request->amount,
                ];
                
        Payment::insertGetId($payInfo);  
        
        \Session::put('success', 'Payment successful');

        return response()->json(['success' => 'Payment successful']);
    }
}



