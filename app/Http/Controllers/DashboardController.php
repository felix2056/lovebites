<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $orders = $user->orders()->get();
        return view('dashboard.index', compact('user', 'orders'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'old_password' => ['string'],
            'new_password' => ['string'],
            'confirm_password' => ['string']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if ($request->old_password && $request->new_password && $request->confirm_password) {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->new_password === $request->confirm_password) {
                    $user->password = Hash::make($request->new_password);
                } else {
                    return redirect()->back()->with('error', 'New password and confirm password do not match');
                }
            } else {
                return redirect()->back()->with('error', 'Old password is incorrect');
            }
        }
        
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateBilling(Request $request)
    {
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_name' => ['string', 'max:255'],
            'address_1' => ['required', 'string', 'max:255'],
            'address_2' => ['string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->company_name = $request->company_name;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        $user->country = $request->country;

        $user->save();

        return redirect()->back()->with('success', 'Billing information updated successfully');
    }
}
