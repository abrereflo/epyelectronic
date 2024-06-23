<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $fillable = [
            'name',
            'description'
            ];
    public function pructsfamily()
    {
        return $this->hasMany(ProductFamily::class, 'product_types_id', 'id');
    }

}
