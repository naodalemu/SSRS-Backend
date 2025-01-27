<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuItemController extends Controller
{
    public function index()
    {
        // Use Eager Loading to fetch related tags and ingredients with each menu item
        $menuItems = MenuItem::with(['tags', 'ingredients'])->get();

        // Return the menu items as a JSON response
        return response()->json($menuItems, 200);
    }
}
