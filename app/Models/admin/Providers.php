<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'last_name',
        'full_name',
        'phone',
        'direction',
        'email',
        'phone_company',
        'business_name',
        'nit',
        'type_supplier',
    ];
}
