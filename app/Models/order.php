<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'order_date',
        'total_amount',
        'order_status',
        'customer_ip',
        'customer_generated_id',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function orderItems()
    {
        return $this->hasMany(orderItem::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
    public function menuItem()
{
    return $this->belongsTo(MenuItem::class);
}
}
