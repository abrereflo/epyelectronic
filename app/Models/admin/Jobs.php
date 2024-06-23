<?php

namespace App\Models\admin;

use App\Models\admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use OwenIt\Auditing\Contracts\Auditable;


class Jobs extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['jobs','jobable_id', 'jobable_type', 'business_name ', 'nit'];

    public function client()
    {

        return $this->morphTo();
    }

    public function jobable()
    {
        return $this->morphTo(Client::class, 'jobable');
    }



}
