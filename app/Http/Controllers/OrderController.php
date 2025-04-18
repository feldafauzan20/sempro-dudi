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
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock. Available: ' . $product->stock
            ], 400);
        }

        if ($request->quantity == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Quantity must be greater than 0'
            ], 400);
        }

        $product->stock -= $request->quantity;
        $product->save();

        Order::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully'
        ], 200);
    }
}