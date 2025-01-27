<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\tags;

class MenuItemSeeder extends Seeder
{
    public function run()
    {
        // Create some menu items
        $menuItems = MenuItem::factory()->count(10)->create();

        foreach ($menuItems as $menuItem) {
            // Attach random tags
            $tags = tags::all();
            if ($tags->count()) {
                $randomTagCount = rand(1, min(3, $tags->count()));
                $selectedTags = $tags->random($randomTagCount)->pluck('id');
                $menuItem->tags()->attach($selectedTags);
            }

            // Attach random ingredients
            $ingredients = Ingredient::all();
            if ($ingredients->count()) {
                $randomIngredientCount = rand(1, min(5, $ingredients->count())); 
                $selectedIngredients = $ingredients->random($randomIngredientCount)->pluck('id');
                $menuItem->ingredients()->attach($selectedIngredients);
            }
        }
    }
}
