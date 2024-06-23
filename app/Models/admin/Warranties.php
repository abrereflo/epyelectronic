<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranties extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsToMany(Product::class,'warranties_products', 'warrantie_id', 'product_id')
                    ->withTimestamps()
                    ->withPivot('description');
    }
}
