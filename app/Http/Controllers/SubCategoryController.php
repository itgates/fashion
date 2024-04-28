<?php

namespace App\Http\Controllers;

use App\Enums\ResponseType;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::paginate(10);

        return response()->json($subCategories, ResponseType::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);


        return response()->json([], ResponseType::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        return response()->json($subCategory, ResponseType::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $subCategory->name = $request->name ?? $subCategory->name;
        $subCategory->category_id = $request->category_id ?? $subCategory->category_id;

        if($subCategory->isDirty()){
            $subCategory->save();
        }

        return response()->json($subCategory, ResponseType::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubCategory::findOrFail($id)
            ->delete();

        return response()->json([], ResponseType::HTTP_OK);
    }
}
