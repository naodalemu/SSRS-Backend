<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menuIngredient extends Model
{

    use HasFactory;
    protected $fillable = [
        'menu_item_id',
        'ingredient_id'
    ];

    public function ingredient()
    {
        return $this->belongsTo(ingredient::class);
    }
}
