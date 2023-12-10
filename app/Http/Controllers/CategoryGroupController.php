<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryGroupReqeust;
use App\Http\Requests\UpdateCategoryGroupReqeust;
use App\Models\CategoryGroup;
use Illuminate\Http\Request;

class CategoryGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(StoreCategoryGroupReqeust $request)
    {
        $categoryGroup = new CategoryGroup();
        $categoryGroup->fill($request->all($categoryGroup->getFillable()));
        $categoryGroup->save();
        if ($request->expectsJson()) {
            return response()->json($categoryGroup, 201);
        }
        return redirect()->route('categories.index')->with(['success' => [
            'title' => 'Category group created!',
            'text' => 'Category group ' . $categoryGroup->name . ' has been created.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryGroup $categoryGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryGroup $categoryGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryGroupReqeust $request, CategoryGroup $categoryGroup)
    {
        $categoryGroup->fill($request->all($categoryGroup->getFillable()));
        $categoryGroup->save();
        if ($request->expectsJson()) {
            return response()->json($categoryGroup, 200);
        }
        return redirect()->route('categories.index')->with(['success' => [
            'title' => 'Tag group updated!',
            'text' => 'Tag group ' . $categoryGroup->name . ' has been updated.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryGroup $categoryGroup)
    {
        $categoryGroup->categories()->delete();
        $categoryGroup->delete();
        if (request()->expectsJson()) {
            return response()->json($categoryGroup, 204);
        }
        return redirect()->route('tags.index')->with(['success' => [
            'title' => 'Category group deleted!',
            'text' => 'Category group ' . $categoryGroup->name . ' has been deleted.',
            'color' => 'bg-green-500/60'
        ]]);
    }
}
