<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
