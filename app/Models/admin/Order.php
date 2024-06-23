<?php

namespace App\Models\admin;

use App\Models\admin\Inventories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Order extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = [
        'quotations_id',
        'date',
        'number',
        'totalprice',
        'statu',
    ];

    public function inventory()
    {
        return $this->hasMany(Inventories::class, 'product_id');
    }

    public function cotizacion()
    {
        return $this->belongsTo(Quotation::class, 'quotations_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'orders_products', 'orders_id', 'products_id')
        ->withPivot('amount','UnitPrice')
        ->withTimestamps();
    }
}
