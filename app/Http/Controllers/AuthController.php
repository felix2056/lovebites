<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard');
            }

            return redirect()->back()->with('error', 'Invalid credentials');
        }

        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:doctors'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // \Torann\GeoIP\Location {
        //     #attributes:array [
        //         'ip'           => '232.223.11.11',
        //         'iso_code'     => 'US',
        //         'country'      => 'United States',
        //         'city'         => 'New Haven',
        //         'state'        => 'CT',
        //         'state_name'   => 'Connecticut',
        //         'postal_code'  => '06510',
        //         'lat'          => 41.28,
        //         'lon'          => -72.88,
        //         'timezone'     => 'America/New_York',
        //         'continent'    => 'NA',
        //         'currency'     => 'USD',
        //         'default'      => false,
        //     ]
        // }

        // $location = geoip()->getLocation($request->ip());
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'state' => $location->state,
            // 'city' => $location->city,
            // 'zip' => $location->postal_code,
            // 'country' => $location->country,
            // 'iso_code' => $location->iso_code,
            // 'timezone' => $location->timezone,
        ]);

        Auth::login($user);
        
        return redirect()->route('home');

        return response()->json([
            'success' => $user ? true : false,
            'message' => $user ? 'User registered successfully' : 'User registration failed!'
        ], $user ? 200 : 422);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $remember_me = ( !empty( $request->remember_me ) ) ? true : false;

        $location = geoip()->getLocation($request->ip());

        $is_authenticated = false;
        $guard = null;

        if(Auth::guard('doctors')->attempt($request->all(), $remember_me )) {
            config(['sanctum.guard' => 'doctors']);
            Auth::shouldUse('doctors');
            $doctor = Doctor::find(Auth::user()->id);
            $doctor->lat = $location->lat;
            $doctor->lng = $location->lon;
            $doctor->state = $location->state;
            $doctor->city = $location->city;
            $doctor->zip = $location->postal_code;
            $doctor->country = $location->country;
            $doctor->iso_code = $location->iso_code;
            $doctor->timezone = $location->timezone;
            $doctor->save();

            $is_authenticated = true;
        }

        elseif(Auth::guard('users')->attempt($request->all(), $remember_me )) {
            config(['sanctum.guard' => 'users']);
            Auth::shouldUse('users');
            $user = User::find(Auth::user()->id);
            $user->state = $location->state;
            $user->city = $location->city;
            $user->zip = $location->postal_code;
            $user->country = $location->country;
            $user->iso_code = $location->iso_code;
            $user->timezone = $location->timezone;
            $user->save();

            $is_authenticated = true;
        }
    
        if($is_authenticated) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true, 
                'message' => 'Logged in successfully!', 
                'guard' => config('sanctum.guard'),
                'user' => Auth::user()
            ], 200);
        } 

        return response()->json(['success' => false, 'message' => 'Invalid credentials!'], 402);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return response()->json(['success' => true, 'message' => 'Logged out successfully!'], 200);
    }

    public function checkUserEmailUnique(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->exists();
        $doctor = Doctor::where('email', $request->email)->exists();

        if($user || $doctor) {
            return response()->json(['success' => false, 'message' => 'Email is already taken!']);
        }

        return response()->json(['success' => true, 'message' => 'Email is valid!']);
    }

    public function checkUserPhoneUnique(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('phone', $request->phone)->first();
        $doctor = Doctor::where('phone', $request->phone)->first();

        if($user || $doctor) {
            return response()->json(['success' => false, 'message' => 'Phone already exists!']);
        }

        return response()->json(['success' => true, 'message' => 'Phone is valid!']);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string'],
            'confirm_password' => ['required', 'string', 'same:new_password']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user_type = $this->get_guard();
        $user = Auth::guard($user_type)->user();

        if(!$user) return response()->json(['success' => false, 'message' => 'User not found!'], 404);

        switch($user_type) {
            case 'users':
                $user = User::find($user->id);
                break;
            case 'doctors':
                $user = Doctor::find($user->id);
                break;
            case 'admins':
                // $user = Admin::find($user->id);
                break;
        }

        // check if old password is correct
        if(!Hash::check($request->old_password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Old password is incorrect!'], 402);
        }

        // check if new password is same as old password
        if(Hash::check($request->new_password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'New password is same as old password!'], 402);
        }

        // check if new password and confirm password are same
        if($request->new_password != $request->confirm_password) {
            return response()->json(['success' => false, 'message' => 'New password and confirm password do not match!'], 402);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Password changed successfully!'], 200);
    }

    public function user()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function get_guard()
    {
        if(Auth::guard('admins')->check())
            {return "admins";}
        elseif(Auth::guard('doctors')->check())
            {return "doctors";}
        elseif(Auth::guard('users')->check())
            {return "users";}
    }
}
