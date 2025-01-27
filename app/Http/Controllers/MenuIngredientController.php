<?php

namespace App\Http\Controllers;
use App\Models\menuingredient;
use App\Models\ingredient;

use Illuminate\Http\Request;

class MenuIngredientController extends Controller
{
    public function index()
    {


            $menu = menuIngredient::all();
            $menuIngredients = $menu->ingredients;
            return view('Tables.menuingredient.index', compact('menu','menuIngredients' ));

    }

    public function create($menuitemId)
    {
        $menu = menuingredient::All();
        $ingredients = Ingredient::all();
        return view('menuingredients.create', compact('menu', 'ingredients'));
    }

    public function store(Request $request, $Id)
    {
        $validatedData = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric',
            'unit' => 'required|string|max:50',
        ]);


        $menuItem = menuingredient::findOrFail($Id);
        $menuItem->ingredients()->attach($validatedData['ingredient_id'], [
            'quantity' => $validatedData['quantity'],
            'unit' => $validatedData['unit'],
        ]);

        return redirect()->route('menuingredients.index', $Id)->with('success', 'Menu ingredient added successfully.');
    }

    public function edit($menuitemId, $ingredientId){

    ////$menuitemId = menuingredient::All();
       // $ingredient = Ingredient::findOrFail($ingredientId);
       // $menuIngredient = $menuitem->ingredients()->where('ingredient_id', $ingredientId)->first();
       /// return view('menuingredients.edit', compact('menuitem', 'ingredient', 'menuIngredient'));
    }

    public function update(Request $request, $menuId, $ingredientId)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|numeric',
            'unit' => 'required|string|max:50',
        ]);
        $menu = menuingredient::findOrFail($menuId);
        $menu->ingredients()->updateExistingPivot($ingredientId, [
            'quantity' => $validatedData['quantity'],
            'unit' => $validatedData['unit'],
        ]);

        return redirect()->route('menu-ingredients.index', $menuId)->with('success', 'Menu ingredient updated successfully.');
    }

    public function delete($menuId, $ingredientId)
    {
        $menu =
        $menu = menuingredient::findOrFail($menuId);
        $menu->ingredients()->detach($ingredientId);

        return redirect()->route('menu-ingredients.index', $menuId)->with('success', 'Menu ingredient deleted successfully.');
    }
}
