<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Food;
use App\Models\Merchant;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Food::query();
        if ($request->has('type_of_food') && $request->type_of_food != '') {
            $query->where('type_of_food', $request->type_of_food);
        }
    
        $foods = $query->get();
    
        return view('customer.index', compact('foods'));
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
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
    public function orderIndex()
    {
        $id = Auth::id();
        $order = Order::where('customer_id', $id)->get();

        return view('customer.orders.index', compact('order'));
    }

    public function order(Request $request)
    {
        $userId = Auth::id();
        $customer = Customer::where('user_id', $userId)->first();

        $food = Food::find($request->id);

        return view('customer.orders.create', compact('customer', 'food'));
    }
    
    public function storeOder(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'qty' => 'required|integer|min:1',
            'delivery_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
    
        $food = Food::findOrFail($request->food_id);

        if ($request->qty > $food->stock) {
            return redirect()->back()->withErrors(['qty' => 'Jumlah pesanan melebihi stok yang tersedia.']);
        }
    
        $totalPrice = $food->price * $request->qty;
    
        $order = Order::create([
            'customer_id' => Auth::id(), 
            'merchant_id' => $food->id_merchant,
            'food_id' => $food->id,
            'order_number' => uniqid('ORD-'),
            'qty' => $request->qty,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'delivery_date' => $request->delivery_date,
            'notes' => $request->notes,
        ]);
    
        $food->stock -= $order->qty;
        $food->save();
    
        return redirect()->route('orders.show', $order->id)->with('success', 'Order berhasil dibuat!');
    }
    

}
