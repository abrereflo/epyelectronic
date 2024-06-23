<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('city_id')->nullable()->index();
            $table->foreignId('city')->nullable()->index();
            $table->string('code',150)->unique();
            $table->string('name',150);
            $table->string('lastname', 150);
            $table->string('phone', 12);
            $table->string('address', 200)->nullable();
            $table->string('ci', 15)->unique();
            $table->string('email')->unique();
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
        Schema::dropIfExists('clients');
    }
}
