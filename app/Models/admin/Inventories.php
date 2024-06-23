<?php

namespace App\Models\admin;

use App\Models\admin\Product;
use App\Models\admin\Providers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Inventories extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'inventories';

    protected $casts = [
        'serial_number' => 'integer',
    ];

    protected $fillable = [
        'product_id',
        'nit',
        'batch',
        'fecha',
        'total'
    ];

  /*   public function producto()
    {
       return $this->belongsTo(Product::class, 'product_id');
    } */

    public function proveedor()
    {
        return $this->belongsTo(Providers::class, 'provider_id');
    }

    public function warranties()
    {
         return $this->belongsToMany(Warranties::class,'warranties_products', 'warrantie_id', 'inventorie_id')
                    ->withTimestamps()
                    ->withPivot('warranty');
    }

    public function producto()
    {
         return $this->belongsToMany(Product::class,'inventories_products', 'inventorie_id', 'product_id')
                    ->withPivot('price', 'quantity', 'total_amount')
                    ->withTimestamps();
    }
}
