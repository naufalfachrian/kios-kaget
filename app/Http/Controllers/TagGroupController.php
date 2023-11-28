<?php

namespace App\Http\Controllers;

use App\Models\TagGroup;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, TagGroup $tagGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagGroup $tagGroup)
    {
        //
    }
}
