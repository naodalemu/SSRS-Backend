<?php

namespace App\Http\Controllers;

use App\Models\ingredient;
use App\Models\menuIngredient;
use App\Models\MenuItem;
use App\Models\MenuTag;
use App\Models\tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


// MenuItemController.php
class MenuItemController extends Controller
{
    public function index()
    {
        $tags = tags::all();
        $menuItems = menuitem::all();
        return view('Tables.menuitem.index', compact('menuItems', 'tags'));
    }

    public function create()

    {
        $menuItem = new MenuItem();
        $tags = tags::all();
        $ingredients = ingredient::all();
        return view('Tables.menuitem.create', compact('tags', 'ingredients', 'menuItem'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'tags' => 'required|array',
            'ingredients' => 'required|array',
            'categories' => 'required|string',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $menuItem = MenuItem::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'categories' => $validatedData['categories'],
            'image' => $imagePath,

        ]);

        // Associate tags with the menu item
        foreach ($validatedData['tags'] as $tagId) {
            MenuTag::create([
                'menu_item_id' => $menuItem->id,
                'tag_id' => $tagId,
            ]);
        }
        // Associate ingredients with the menu item
        foreach ($validatedData['ingredients'] as $ingredientId) {
            menuIngredient::create([
                'menu_item_id' => $menuItem->id,
                'ingredient_id' => $ingredientId,
            ]);
        }

        return redirect()->route('menuitem.index')->with('success', 'MenuItem created successfully.');
    }



    public function show($id)
    {
        $menuItem = $menuItem = MenuItem::with('ingredients', 'tags')->findOrFail($id);
        return view('Tables.menuitem.show', compact('menuItem'));
    }

    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $tags = tags::all();
        $ingredients = Ingredient::all();

        return view('Tables.menuitem.edit', compact('menuItem', 'tags', 'ingredients'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'categories' => 'nullable|string',
            'tags' => 'nullable|array',
            'ingredients' => 'required|array',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:4096', // Image is now optional
        ]);

        $menuItem = MenuItem::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $menuItem->image = $imagePath;
        }

        $menuItem->name = $validatedData['name'];
        $menuItem->description = $validatedData['description'];
        $menuItem->price = $validatedData['price'];
        $menuItem->categories = $validatedData['categories'];
        $menuItem->save();

       // Update tags
if (isset($validatedData['tags'])) {
    // Detach existing tags
    $menuItem->tags()->detach();

    // Attach new tags
    foreach ($validatedData['tags'] as $tagId) {
        if (tags::find($tagId)) { // Ensure the model name is capitalized
            $menuItem->tags()->attach($tagId);
        } else {
            Log::warning('Tag with id ' . $tagId . ' does not exist.');
        }
    }
}

// Update ingredients
if (isset($validatedData['ingredients'])) {
    // Get current ingredient IDs
    $currentIngredientIds = $menuItem->ingredients()->pluck('ingredients.id')->toArray(); // Fully qualify the column

    // Detach ingredients not in the new list
    foreach ($currentIngredientIds as $currentIngredientId) {
        if (!in_array($currentIngredientId, $validatedData['ingredients'])) {
            $menuItem->ingredients()->detach($currentIngredientId);
        }
    }

    // Attach new ingredients
    foreach ($validatedData['ingredients'] as $ingredientId) {
        if (Ingredient::find($ingredientId)) {
            // Only attach if not already attached
            if (!in_array($ingredientId, $currentIngredientIds)) {
                MenuIngredient::create([
                    'menu_item_id' => $menuItem->id,
                    'ingredient_id' => $ingredientId,
                ]);
            }
        } else {
            Log::warning('Ingredient with id ' . $ingredientId . ' does not exist.');
        }
    }
}

// Redirect with success message
return redirect()->route('menuitem.index', $menuItem->id)->with('success', 'Menu item updated successfully.');
}


    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('menuitem.index')->with('success', 'Menu item deleted successfully.');
    }
}
