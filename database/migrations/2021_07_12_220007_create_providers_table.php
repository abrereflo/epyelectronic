<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('name', 80);
            $table->string('last_name', 100);
            $table->string('full_name', 100);
            $table->string('phone',20);
            $table->string('direction',150)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone_company')->nullable();
            $table->string('business_name',100)->nullable();
            $table->string('nit',20)->unique()->nullable();
            $table->string('type_supplier', 100)->nullable();
            $table->enum('status', ['1','2','3'])->default('1');
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
        Schema::dropIfExists('providers');
    }
}
