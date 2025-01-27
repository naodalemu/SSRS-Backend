<?php

// database/factories/TagFactory.php

namespace Database\Factories;

use App\Models\tags;
use Illuminate\Database\Eloquent\Factories\Factory;

class tagsFactory extends Factory
{
    protected $model = tags::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['lunch', 'dinner', 'breakfast', $this->faker->word()]),
            'description' => $this->faker->sentence(),
        ];
    }
}
