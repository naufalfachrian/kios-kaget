<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Models\TagGroup;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Tag::class);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagGroups = TagGroup::query()->orderBy('created_at', 'DESC')->paginate(10);
        return view('tags.index', [
            'tagGroups' => $tagGroups
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
    public function store(StoreTagRequest $request)
    {
        $tag = new Tag();
        $tag->fill($request->all($tag->getFillable()));
        $tag->save();
        if ($request->expectsJson()) {
            return response()->json($tag, 201);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Tag created!',
            'text' => 'Tag ' . $tag->name . ' has been created.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->fill($request->all($tag->getFillable()));
        $tag->save();
        if ($request->expectsJson()) {
            return response()->json($tag, 200);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Tag updated!',
            'text' => 'Tag ' . $tag->name . ' has been updated.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Tag deleted!',
            'text' => 'Tag ' . $tag->name . ' has been deleted.',
            'color' => 'bg-green-500/60'
        ]]);
    }
}