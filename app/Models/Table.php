<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable=[
        'table_number',
        'table_status',
        'qr_code'
       ];


    public function orders()
    {
        return $this->hasMany(order::class);
    }
    public function orderItem()
    {
        return $this->hasMany(orderItem::class);
    }
}
