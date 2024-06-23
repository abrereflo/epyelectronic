<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantiesProductsTable extends Migration
{

    public function up()
    {
        Schema::create('warranties_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warrantie_id')->constrained('warranties');
            $table->foreignId('product_id')->constrained('products');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warranties_products');
    }
}
