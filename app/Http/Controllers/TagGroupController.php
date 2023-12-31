<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagGroupRequest;
use App\Http\Requests\UpdateTagGroupRequest;
use App\Models\TagGroup;

class TagGroupController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(TagGroup::class);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTagGroupRequest $request)
    {
        $tagGroup = new TagGroup();
        $tagGroup->fill($request->all($tagGroup->getFillable()));
        $tagGroup->save();
        if ($request->expectsJson()) {
            return response()->json($tagGroup, 201);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Tag group created!',
            'text' => 'Tag group ' . $tagGroup->name . ' has been created.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TagGroup $tagGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TagGroup $tagGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagGroupRequest $request, TagGroup $tagGroup)
    {
        $tagGroup->fill($request->all($tagGroup->getFillable()));
        $tagGroup->save();
        if ($request->expectsJson()) {
            return response()->json($tagGroup, 200);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Tag group updated!',
            'text' => 'Tag group ' . $tagGroup->name . ' has been updated.',
            'color' => 'bg-green-500/60'
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagGroup $tagGroup)
    {
        $tagGroup->tags()->delete();
        $tagGroup->delete();
        if (request()->expectsJson()) {
            return response()->json($tagGroup, 204);
        }
        return redirect()->back()->with(['success' => [
            'title' => 'Tag group deleted!',
            'text' => 'Tag group ' . $tagGroup->name . ' has been deleted.',
            'color' => 'bg-green-500/60'
        ]]);
    }
}
