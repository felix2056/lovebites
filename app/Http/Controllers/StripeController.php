<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use \Stripe\Stripe;
use \Stripe\StripeClient;

use App\User;
use App\Product;

class StripeController extends Controller
{
    public $stripe;

    public function __construct()
    {
        // $this->stripe = Stripe::setApiKey(env('STRIPE_SECRET')); 
        $this->stripe = new StripeClient('sk_test_51KWJuaLYB0I58J6wyzNFqUJfJrlJcZx3aDrdCqaJOnlFOaiiFe4lkYO0jktDVWBUk91ZBEDsXSZMUwxqxjQxClfc00BugRFEtr');
    }

    public function create(Request $request)
    {
        $cart = session()->get('cart');
        if(!$cart || count($cart) == 0) {
            return response()->json(['error' => 'No items in cart.'], 400);
        }
        
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += (float) $item['price'] * $item['quantity'];
        }

        $shipping_fee = 3.99;
        $tax = $subtotal * 0.15;
        $total_amount = $subtotal + $shipping_fee + $tax;

        try {
            if(Auth::check()) {
                $user = User::find(Auth::user()->id);

                // create a new customer or attach existing to payment intent
                $customer = [];
                if (is_null($user->stripeId)) {
                    $customer = $this->stripe->customers->create([
                        'email' => $user->email,
                        'name' => $user->full_name,
                        'phone' => $user->phone,
                        'address' => [
                            'line1' => $user->address_1,
                            'city' => $user->city,
                            'state' => $user->state,
                            'postal_code' => $user->zip,
                            'country' => $user->country,
                        ],
                    ]);

                    $user->stripeId = $customer->id;
                    $user->save();
                } else {
                    $customer = $this->stripe->customers->retrieve($user->stripeId);
                }

                // check if customer has a payment method attached
                // $payment_method = $this->stripe->paymentMethods->all(
                //     ['customer' => $customer->stripeId, 'type' => 'card']
                // );
            } else {
                // get shipping info from session
                $user = session()->get('user_information');
                $customer = $this->stripe->customers->create([
                    'email' => $user['email'],
                    'name' => $user['first_name'] . ' ' . $user['last_name'],
                    'phone' => $user['phone'],
                    'address' => [
                        'line1' => $user['address_1'],
                        'city' => $user['city'],
                        'state' => $user['state'],
                        'postal_code' => $user['zip'],
                        'country' => $user['country'],
                    ],
                ]);
            }

            // create a new payment intent
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => number_format(($total_amount * 100) , 0, '', ''),
                'customer' => $customer->id,
                'setup_future_usage' => 'off_session',
                'currency' => 'usd',
                'description' => 'Payment for order',
                'automatic_payment_methods' => [
                    'enabled' => 'true',
                ]
            ]);

            // insert payment intent id into session
            session()->put('payment_intent_id', $paymentIntent->id);

            return response()->json([
                'success' => true,
                'payment_intent' => $paymentIntent,
                'clientSecret' => $paymentIntent->client_secret,
                'message' => 'Payment intent generated'
            ], 200);
        } catch (\Stripe\Exception\CardException $e) {
            return response()->json(['error' => $e->getError()->message], 400);
        }
    }

    public function checkoutWithElements(Request $request)
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = session()->get('cart');
        if(!$cart || count($cart) == 0) {
            return response()->json(['error' => 'No items in cart.'], 400);
        }

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $company_name = $request->input('company_name') ?? NULL;
        $country = $request->input('country');
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2') ?? NULL;
        $city = $request->input('city');
        $state = $request->input('state');
        $zip = $request->input('zip');
        $phone = $request->input('phone');
        $email = $request->input('email');

        if (!Auth::check()) {
            // check if create account is checked
            $create_account = $request->input('create_account');
            if($create_account) {
                $password = $request->input('password');

                // validate the request
                $validator = Validator::make($request->all(), [
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required|min:8'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // create a new user
                $user = User::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'company_name' => $company_name,
                    'country' => $country,
                    'address_1' => $address_1,
                    'address_2' => $address_2,
                    'city' => $city,
                    'state' => $state,
                    'zip' => $zip,
                    'phone' => $phone,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);

                // login the user
                Auth::login($user);
            } else {
                // store data in session
                session()->put('user_information', [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'company_name' => $company_name,
                    'country' => $country,
                    'address_1' => $address_1,
                    'address_2' => $address_2,
                    'city' => $city,
                    'state' => $state,
                    'zip' => $zip,
                    'phone' => $phone,
                    'email' => $email,
                ]);
            }
        } else {
            $user = User::find(Auth::id());
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->company_name = $company_name;
            $user->country = $country;
            $user->address_1 = $address_1;
            $user->address_2 = $address_2;
            $user->city = $city;
            $user->state = $state;
            $user->zip = $zip;
            $user->phone = $phone;
            $user->email = $email;
            $user->save();
        }

        return redirect()->route('checkout.stripe');
    }

    public function checkoutWithCheckout(Request $request)
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = session()->get('cart');
        if(!$cart || count($cart) == 0) {
            return response()->json(['error' => 'No items in cart.'], 400);
        }

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $company_name = $request->input('company_name') ?? NULL;
        $country = $request->input('country');
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2') ?? NULL;
        $city = $request->input('city');
        $state = $request->input('state');
        $zip = $request->input('zip');
        $phone = $request->input('phone');
        $email = $request->input('email');

        if (!Auth::check()) {
            // check if create account is checked
            $create_account = $request->input('create_account');
            if($create_account) {
                $password = $request->input('password');

                // validate the request
                $validator = Validator::make($request->all(), [
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required|min:8'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // create a new user
                $user = User::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'company_name' => $company_name,
                    'country' => $country,
                    'address_1' => $address_1,
                    'address_2' => $address_2,
                    'city' => $city,
                    'state' => $state,
                    'zip' => $zip,
                    'phone' => $phone,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);

                // login the user
                Auth::login($user);
            }
        } else {
            $user = User::find(Auth::id());
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->company_name = $company_name;
            $user->country = $country;
            $user->address_1 = $address_1;
            $user->address_2 = $address_2;
            $user->city = $city;
            $user->state = $state;
            $user->zip = $zip;
            $user->phone = $phone;
            $user->email = $email;
            $user->save();
        }
        
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += (float) $item['price'] * $item['quantity'];
        }

        $shipping_fee = 10;
        $tax = 0.15 * $subtotal;
        $total_amount = $subtotal + $shipping_fee + $tax;

        try {
            // create a new checkout session
            $checkout_session = $this->stripe->checkout->sessions->create([
                'customer_email' => $email,
                'submit_type' => 'pay',
                'billing_address_collection' => 'required',
                'shipping_address_collection' => [
                    'allowed_countries' => ['US', 'CA', 'GB', 'AU'],
                ],
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Order',
                        ],
                        'unit_amount' => number_format(($total_amount * 100) , 0, '', ''),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.success'),
                'cancel_url' => route('stripe.cancel'),
            ]);

            return redirect()->away($checkout_session->url);
        } catch (\Stripe\Exception\CardException $e) {
            return response()->json(['error' => $e->getError()->message], 400);
        }
    }

    public function store(Request $request)
    {
        return response()->json($request);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'card_no' => 'required|numeric',
            'exp_month' => 'required|numeric',
            'exp_year' => 'required|numeric',
            'cvc' => 'required|numeric',
        ]);

        $input = $request->all();

        $stripe = Stripe::make(env('STRIPE_SECRET'));

        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $input['card_no'],
                    'exp_month' => $input['exp_month'],
                    'exp_year' => $input['exp_year'],
                    'cvc' => $input['cvc'],
                ],
            ]);

            if (!isset($token['id'])) {
                return redirect()->back()->with('error', 'Token Problem With Your Token.');
            }

            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'USD',
                'amount' => 10,
                'description' => 'Add in wallet',
            ]);

            if ($charge['status'] == 'succeeded') {
                // here write your database logic after getting payment token successfully.
            }

            return redirect()->back()->with('success', 'Money add successfully in wallet');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function success()
    {
        return view('stripe.success');
    }

    public function cancel()
    {
        return view('stripe.cancel');
    }
}
