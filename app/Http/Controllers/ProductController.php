<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('products.index')
                ->withErrors($validator)
                ->withInput();
        }

        $image = $request->image->store('images', 'public');
        $slug = Str::slug($request->name);
        $validated = $validator->validated();

        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $image,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'slug' => $slug,
        ]);

        // return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name,' . $id . ',id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048|unique:products,image,' . $id . ',id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('products.index')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->image->store('images', 'public');
        } else {
            $image = Product::find($id)->image;
        }
        $slug = Str::slug($request->name);
        $validated = $validator->validated();

        Product::where('id', $id)->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $image,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'slug' => $slug,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
