<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewIdColumnInBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->integer('id_new')->unsigned()->default(0);
        });
        DB::update('update blocks set id_new = id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            //
        });
    }
}
