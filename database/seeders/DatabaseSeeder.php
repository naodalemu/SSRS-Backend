<?php

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\ingredient;
use App\Models\tags;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create the specific required tags
        $requiredTags = [
            tags::firstOrCreate(
                ['name' => 'lunch'], 
                ['description' => 'This is a lunch tag']
            ),
            tags::firstOrCreate(
                ['name' => 'dinner'], 
                ['description' => 'This is a dinner tag']
            ),
            tags::firstOrCreate(
                ['name' => 'breakfast'], 
                ['description' => 'This is a breakfast tag']
            ),
        ];

        $randomTags = tags::factory(5)->create();  // Creates 5 random tags
        $ingredients = ingredient::factory(10)->create();

        // Create menu items and attach at least one required tag and random ingredients
        MenuItem::factory(20)->create()->each(function ($menuItem) use ($ingredients, $requiredTags, $randomTags) {
            $menuItem->tags()->attach($requiredTags[array_rand($requiredTags)]);
            $menuItem->tags()->attach($randomTags->random(rand(1, 3))->pluck('id')->toArray());
            $menuItem->ingredients()->attach($ingredients->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
