<?php

namespace App\Http\Controllers;

use App\Enums\ResponseType;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::with('category', 'subCategory')->paginate(10);

        return response()->json($data, ResponseType::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
        ]);


        return response()->json([], ResponseType::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::findOrFail($id);

        return response()->json($data, ResponseType::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name ?? $product->name;
        $product->category_id = $request->category_id ?? $product->category_id;
        $product->sub_category_id = $request->sub_category_id ?? $product->sub_category_id;
        $product->description = $request->description ?? $product->description;
        $product->image = $request->image ?? $product->image;

        if($product->isDirty()){
            $product->save();
        }

        return response()->json([], ResponseType::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)
            ->delete();

        return response()->json([], ResponseType::HTTP_OK);
    }
}
