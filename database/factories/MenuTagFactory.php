<?php

// database/factories/MenuTagFactory.php

namespace Database\Factories;

use App\Models\MenuTag;
use App\Models\MenuItem;
use App\Models\tags;  // Renamed class to Tag
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuTagFactory extends Factory
{
    protected $model = MenuTag::class;

    public function definition()
    {
        return [
            'menu_item_id' => MenuItem::factory(),
            'tag_id' => tags::factory(),  // Corrected class name
        ];
    }
}
