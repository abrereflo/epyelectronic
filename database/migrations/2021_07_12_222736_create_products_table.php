<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_families_id')->constrained('product_families');
            $table->foreignId('product_types_id')->constrained();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('code', 150)->unique();
            $table->double('min_mrp', 150)->default(0);
            $table->double('mrp', 150)->default(0);
            $table->double('price', 150)->default(0);
            $table->integer('alert_quantity')->default(0);
            $table->string('name', 200)->unique();
            $table->string('image',250)->nullable();
            $table->text('description')->nullable();
            $table->integer('stock')->default(0);
            $table->date('date');
            $table->boolean('statu')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
