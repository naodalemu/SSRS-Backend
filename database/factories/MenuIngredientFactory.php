<?php

// database/factories/MenuIngredientFactory.php

namespace Database\Factories;

use App\Models\MenuIngredient;
use App\Models\Ingredient;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuIngredientFactory extends Factory
{
    protected $model = MenuIngredient::class;

    public function definition()
    {
        return [
            'ingredient_id' => Ingredient::factory(),  // Generate a new Ingredient
            'menu_item_id' => MenuItem::factory(),     // Generate a new MenuItem
        ];
    }
}