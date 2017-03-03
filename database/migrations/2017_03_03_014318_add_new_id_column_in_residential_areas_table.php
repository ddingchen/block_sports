<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewIdColumnInResidentialAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residential_areas', function (Blueprint $table) {
            $table->integer('id_new')->unsigned()->default(0);
        });
        DB::update('update residential_areas set id_new = id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residential_areas', function (Blueprint $table) {
            //
        });
    }
}
