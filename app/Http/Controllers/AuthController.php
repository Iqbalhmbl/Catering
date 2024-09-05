<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function formRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_type' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_name' => $data['user_type'],
        ]);
        if ($data['user_type'] === 'merchant') {
            Merchant::create([
                'user_id' => $user->id,
                'company_name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
                'status' => 'active',
            ]);
        } elseif ($data['user_type'] === 'customer') {
            Customer::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'contact_person' => $data['contact_person'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
                'status' => 'active',
            ]);
        }

        return redirect(url('/'))->with('success', 'Registration successful. Please login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            if (Auth::user()->role_name === 'customer') {
                return redirect()->route('customers.index'); 
            } elseif (Auth::user()->role_name === 'merchant') {
                return redirect()->route('merchants.index'); 
            }
    
            return response()->json(['message' => 'Login successful, but role is undefined'], 200);
        }
    
        return redirect(url('/'));
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(url('/')); 
    }
}
