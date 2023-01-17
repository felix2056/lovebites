<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \Stripe\Stripe;
use \Stripe\StripeClient;

class HomeController extends Controller
{
    public function index()
    {
        $popular = Product::orderBy('views', 'desc')->paginate(20);
        $featured = Product::where('featured', true)->take(10)->get();
        $latest = Product::orderBy('created_at', 'desc')->take(10)->get();

        return view('index', compact('popular', 'featured', 'latest'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function wishlist()
    {
        return view('wishlist');
    }

    public function cart()
    {
        return view('cart');
    }

    public function checkout()
    {
        if (!session()->has('cart')) {
            return redirect()->route('products.index');
        }

        return view('checkout-paypal');
    }

    public function checkoutStripe(Request $request)
    {
        // return response()->json([
        //     'session' => session()->all(),
        // ]);

        if (!session()->has('cart')) {
            return redirect()->route('products.index');
        }

        if (!Auth::check()) {
            if (!session()->has('user_information')) {
                return redirect()->route('checkout');
            }
        }

        $cart = session()->get('cart');

        // check if stripe payment succeeded
        if ($request->has('payment_intent') && session()->has('payment_intent_id')) {
            $stripe = new StripeClient('sk_test_51KWJuaLYB0I58J6wyzNFqUJfJrlJcZx3aDrdCqaJOnlFOaiiFe4lkYO0jktDVWBUk91ZBEDsXSZMUwxqxjQxClfc00BugRFEtr');
            $paymentIntent = $stripe->paymentIntents->retrieve(session()->get('payment_intent_id'));

            if ($paymentIntent->status == 'succeeded' || $paymentIntent->status == 'processing') {
                // create order and clear cart
                if (Auth::check()) {
                    $user = User::find(Auth::id());

                    $order = $user->orders()->where('payment_intent_id', $paymentIntent->id)->first();
                    if(!$order) $order = new Order();
                    
                    $order->user_id = $user->id;
                    $order->order_number = uniqid('order_');
                    $order->status = 'pending';
                    $order->payment_method = $paymentIntent->payment_method_types[0];
                    $order->payment_intent_id = $paymentIntent->id;
                    $order->payment_intent_status = $paymentIntent->status;
                    $order->payment_intent_client_secret = $paymentIntent->client_secret;
                    $order->payment_intent_amount = $paymentIntent->amount;
                    $order->payment_intent_currency = $paymentIntent->currency;
                    $order->save();

                    // attach products to order
                    foreach ($cart as $item) {
                        $order->products()->attach($item['id'], ['quantity' => $item['quantity']]);
                    }

                    // clear cart
                    // session()->forget('cart');
                }

                // send email
            }
        }

        return view('checkout-payment');
    }

    public function checkoutPaypal()
    {
        if (!session()->has('cart')) {
            return redirect()->route('products.index');
        }

        if (!Auth::check()) {
            if (!session()->has('user_information')) {
                return redirect()->route('checkout');
            }
        }

        return view('checkout-paypal');
    }
}
