<?php

namespace App\Http\Controllers;

use App\Models\tags;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = tags::all();
        return view('Tables.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('Tables.tag.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Tags::create($request->all());
        return redirect()->route('tag.index')->with('success', 'Tag created successfully.');
    }

    public function show(tags $tag)
    {
        return view('Tables.tag.show', compact('tag'));
    }

    public function edit(Tags $tag)
    {
        return view('Tables.tag.edit', compact('tag'));
        //return redirect()->route('Tag.edit', ['Tag' => $Tag]);
    }

    public function update(Request $request, tags $Tag)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $Tag->update($request->all());
        return redirect()->route('tag.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(tags $tag)
    {
        $tag->delete();
        return redirect()->route('tag.index')->with('success', 'Tag deleted successfully.');
    }

}


