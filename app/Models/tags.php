<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];


    public function menuItem()
{
    return $this->belongsToMany(MenuItem::class, 'menu_tags', 'tag_id', 'menu_item_id');
}

}
