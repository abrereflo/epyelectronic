<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class BitacoraController extends Controller
{
    public function index()
    {
        $metadata = Audit::all();
        return view('admin.bitacora.index', compact('metadata'));
    }
}
