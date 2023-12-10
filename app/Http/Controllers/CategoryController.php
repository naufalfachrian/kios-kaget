<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\CategoryGroup;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryGroups = CategoryGroup::query()->orderBy('created_at', 'DESC')->paginate(10);
        if (count($categoryGroups) == 0 && request()->get('page', 1) > 1) {
            return redirect()->route('categories.index');
        }
        if (Auth::check()) {
            return view('categories.admin.index', [
                'categoryGroups' => $categoryGroups,
            ]);
        }
        return view('categories.index', [
            'categoryGroups' => $categoryGroups,
        ]);
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
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->fill($request->all($category->getFillable()));
        $category->save();
        if ($request->expectsJson()) {
            return response()->json($category, 201);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Category created!',
            'text' => 'Category ' . $category->name . ' has been created.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill($request->all($category->getFillable()));
        $category->save();
        if ($request->expectsJson()) {
            return response()->json($category, 200);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Category updated!',
            'text' => 'Category ' . $category->name . ' has been updated.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Category deleted!',
            'text' => 'Category ' . $category->name . ' has been deleted.',
            'color' => 'bg-green-500/60'
        ]]);
    }
}
