<?php

namespace App\Models\admin;

use App\Models\admin\Deliveries;
use App\Models\admin\Warranties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    public function productfamily()
    {
        return $this->belongsTo(ProductFamily::class, 'product_families_id');
    }

    public function cotizaciones()
    {
        return $this->belongsToMany(Product::class,'quotation_product', 'product_id', 'quotation_id')
        ->withTimestamps()
        ->withPivot('amount','UnitPrice');
    }


    public function deliveries()
    {
        return $this->belongsToMany(Deliveries::class,'deliveries_products', 'deliverie_id', 'product_id')
        ->withTimestamps()
        ->withPivot('serial_number');
    }

  /*   public function inventario()
    {
        return $this->hasMany(Inventories::class);
    }
 */
    public function inventario()
    {
        return $this->belongsToMany(Inventories::class, 'inventories_products', 'product_id', 'inventorie_id')
                    ->withPivot('price', 'quantity', 'total_amount')
                    ->withTimestamps();
    }

    public function warranties()
    {
        return $this->belongsToMany(Warranties::class,'warranties_products', 'warrantie_id', 'product_id')
                    ->withPivot('description')
                    ->withTimestamps();
    }

  /*   public function quotation(){
        return $this->belongsToMany(Quotation::class,'quotation_product', 'quotation_id', 'product_id')
                    ->withPivot('amount','UnitPrice')
                    ->withTimestamps();
    } */
}
