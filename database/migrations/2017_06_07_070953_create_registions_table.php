<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('realname')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->string('tel')->nullable();
            $table->string('idcard_no')->nullable();
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
        Schema::dropIfExists('registions');
    }
}
