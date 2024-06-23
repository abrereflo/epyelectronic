<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductFamily extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = [
        'product_types_id','name', 'description'
        ];

    public function productstype()
    {
        return $this->belongsTo(ProductType::class, 'product_types_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
