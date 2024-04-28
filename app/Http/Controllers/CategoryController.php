<?php

namespace App\Http\Controllers;

use App\Enums\ResponseType;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::paginate(10);

        return response()->json($categories,ResponseType::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
        ]);


        return response()->json([], ResponseType::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category=Category::findOrFail($id);

        return response()->json($category,ResponseType::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category=Category::findOrFail($id);

        $category->update([
            'name' => $request->name
        ]);

        return response()->json($category,ResponseType::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();

        return response()->json([],ResponseType::HTTP_OK);
    }
}
