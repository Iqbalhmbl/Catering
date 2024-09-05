<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('merchant.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merchant $merchant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Merchant $merchant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Merchant $merchant)
    {
        //
    }

    public function editProfile()
    {
        $userId = Auth::user()->id;
        $merchant = Merchant::where('user_id', $userId)->firstOrFail();
        return view('merchant.profile', compact('merchant'));
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::id();
        $merchant = Merchant::where('user_id', $userId)->firstOrFail();

        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $user = User::find($userId);
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        $merchant->update([
            'company_name' => $request->input('company_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('merchant.profile.edit')->with('success', 'Profil Berhasil Di Update.');
    }

}
