<?php

namespace App\Http\Controllers;

use App\Models\MenuTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class MenuTagController extends Controller
{
    public function index()
    {
        $menuTags = MenuTag::all();
        // return $menuModel;
        //$menuTags = $menuModel->tags;
        return view('Tables.menutags.index', compact('menuTags'));
    }

    public function create($ID)
    {
        $menuModel = MenuTag::findOrFail($ID);
        $tags = Tag::all();
        return view('menutags.create', compact('menuModel', 'tags'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tag_id' => 'required|exists:tags,id',
        ]);

       // $menuModel = MenuTag::findOrFail();
       // $menuModel->tags()->attach($validatedData['tagid']);

        return redirect()->route('menutags.index')->with('success', 'Menu tag added successfully.');
    }

    public function destroy($menuId, $tagId)
    {
        $menuModel = MenuTag::findOrFail($menuId);
        $menuModel->tags()->detach($tagId);

        return redirect()->route('menutags.index', $menuId)->with('success', 'Menu tag deleted successfully.');
    }
}
