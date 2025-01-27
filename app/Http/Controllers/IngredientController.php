<?php

namespace App\Http\Controllers;

use App\Models\ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = ingredient::all();
        return view('Tables.Ingredient.index', compact('ingredients'));
    }

    public function create()
    {
        return view('Tables.Ingredient.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ingredient::create($request->all());
        return redirect()->route('ingredient.index')->with('success', 'Tag created successfully.');
    }

    public function show(ingredient $ingredient)
    {
        return view('Tables.Ingredient.show', compact('ingredient'));
    }

    public function edit(ingredient $ingredient)
    {
        return view('Tables.Ingredient.edit', compact('ingredient'));
        //return redirect()->route('Tag.edit', ['Tag' => $Tag]);
    }

    public function update(Request $request, ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $ingredient->update($request->all());
        return redirect()->route('ingredient.index')->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('ingredient.index')->with('success', 'Tag deleted successfully.');
    }

}
