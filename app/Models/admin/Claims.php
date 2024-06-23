<?php

namespace App\Models\Admin;

use App\Models\admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsToMany(Product::class,'claims_products', 'claim_id', 'product_id')
                    ->withPivot('serial', 'description')
                    ->withTimestamps();

    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }


}
