<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $merchantid = Merchant::where('user_id', $id)->first();

        $foods = DB::table('foods')->where('id_merchant', $merchantid->id)->get();
        return view('merchant.food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('merchant.food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        $merchant = Merchant::where('user_id', $id)->first();
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'food_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type_of_food' => 'required|string|max:255',
            'stock' => 'required|integer',
            'portions' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $food = new Food;
        $food->food_name = $request->food_name;
        $food->id_merchant = $merchant->id;
        $food->price = $request->price;
        $food->type_of_food = $request->type_of_food;
        $food->stock = $request->stock;
        $food->portions = $request->portions;
        $food->description = $request->description;

        if ($request->photo) {
            $request->validate( [
                'photo' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $file = $request->file('photo');
            $image_name = time() . '_' . $file->getClientOriginalName();

            $img = Image::make($file->getRealPath());
            $img->resize(550, 550, function ($constraint) {
                $constraint->aspectRatio();
            })->save('food/thumbnail/' . $image_name);

            $file->move('food', $image_name);

            $food->photo = $image_name;
        }
        $food->save();

        return redirect()->route('foods.index')->with('success', 'Menu Makanan Berhasil di Tambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('merchant.food.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('merchant.food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {
        $id = Auth::id();
        $merchant = Merchant::where('user_id', $id)->first();

        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'food_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type_of_food' => 'required|string|max:255',
            'stock' => 'required|integer',
            'portions' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $food->food_name = $request->food_name;
        $food->id_merchant = $merchant->id;
        $food->price = $request->price;
        $food->type_of_food = $request->type_of_food;
        $food->stock = $request->stock;
        $food->portions = $request->portions;
        $food->description = $request->description;
    
        if ($request->hasFile('photo')) {
            if ($food->photo && file_exists(public_path('food/' . $food->photo))) {
                unlink(public_path('food/' . $food->photo));
            }
    
            $request->validate([
                'photo' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $file = $request->file('photo');
            $image_name = time() . '_' . $file->getClientOriginalName();
    
            $img = Image::make($file->getRealPath());
            $img->resize(550, 550, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('food/thumbnail/' . $image_name));
    
            $file->move(public_path('food'), $image_name);
    
            $food->photo = $image_name;
        }
    
        $food->save();
    
        return redirect()->route('foods.index')->with('success', 'Data Menu Makanan Berhasil di Ubah!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        if ($food->photo && file_exists(public_path('food/' . $food->photo))) {
            unlink(public_path('food/' . $food->photo));
        }
        $food->delete();

        return redirect()->route('foods.index')->with('success', 'Menu Makanan Telah di Hapus');
    }
}
