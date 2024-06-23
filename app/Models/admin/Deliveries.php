<?php

namespace App\Models\admin;

use App\Models\admin\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Deliveries extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $fillable = [
        'orders_id',
        'number',
        'direction',
        'date',
        'hour',
        'reference',
    ];


    public function pedidos()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,'deliveries_products', 'deliverie_id', 'product_id')
                    ->withPivot('serial_number')
                    ->withTimestamps();

    }
}
