<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => "required|max:255|unique:products,title",
            'price' => "required|integer",
            'image' => "required|image|max:2048",
            'description' => "required",
        ]);

        $product = Product::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
            'description' => $request->description,
            'image' => 'default.jpg',
        ]);

        if($request->image) {
            // $imageName = time().'_'.uniqid().'.'. $request->image->getClientOriginalExtension();
            // $request->image->move(public_path('storage/product'). $imageName);
            // $product->image = '/storage/product/' . $imageName;
            // $product->save();

            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            Storage::putFileAs('public/product', $request->image, $imageName);
            $product->image = 'storage/product/' . $imageName;
            $product->save();
        }

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product) {
            return response()->json($product, 200);
        }else {
            return response()->json('failed', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title' => "required|max:255|unique:products,title, $product->id",
            'price' => "required|integer",
            'image' => "sometimes|nullable|image",
            'description' => "required",
        ]);

        $product->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
            'description' => $request->description,
            'image' => 'default.jpg',
        ]);

        if($request->image) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            Storage::putFileAs('public/product', $request->image, $imageName);
            $product->image = 'storage/product/' . $imageName;
            $product->save();
        }

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
