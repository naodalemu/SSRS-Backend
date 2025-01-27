<?php

// database/factories/MenuItemFactory.php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => '/images/zbi42ZmvRiBDWrKmEOjuXGwPwZnAu6dvK6NW9ETf.jpg',
            'categories' => $this->faker->randomElement(['drink', 'food']),
            'price' => $this->faker->randomFloat(2, 1, 50),
        ];
    }
}


