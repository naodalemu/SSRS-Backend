<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'categories',
        'tags'
    ];



    // Relationships
    public function orderItem()
    {
        return $this->hasOne(OrderItem::class);
    }

    public function menuIngredients()
    {
        return $this->hasMany(MenuIngredient::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(tags::class, 'menu_tags', 'menu_item_id', 'tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(ingredient::class, 'menu_ingredients');
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}

