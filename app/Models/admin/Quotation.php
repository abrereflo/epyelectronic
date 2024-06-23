<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Product;
use App\Models\admin\Client;
use OwenIt\Auditing\Contracts\Auditable;

class Quotation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = [
        'clients_id',
        'date',
        'number',
        'totalprice',
        'statu ',
    ];

    public function clientee()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

    public function producto(){
        return $this->belongsToMany(Product::class,'quotation_product', 'quotation_id', 'product_id')
        ->withPivot('amount','UnitPrice')
        ->withTimestamps();
    }

 /*    public function pedido()
    {
       return $this->hasMany(Pedido::class);
    } */
}
