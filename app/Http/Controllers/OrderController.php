<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy("created_at", "desc")->get();
        return view('order-list', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'status' => 'required',
            'quantity' => 'required',
        ]);

        $product = Product::find($request->product_id);
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available');
        }

        $product->stock -= $request->quantity;
        $product->save();

        Order::create($request->all());

        return redirect()->route('product-user')->with('success', 'Order created successfully');
    }
}