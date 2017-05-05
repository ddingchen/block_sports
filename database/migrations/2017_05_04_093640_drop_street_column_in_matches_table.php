<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropStreetColumnInMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn('street_id');
            $table->dropColumn('group_id');
            // addition
            $table->string('title')->after('id');
            $table->string('sub-title')->after('title')->nullable();
            $table->unsignedInteger('sport_id')->after('sub-title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->integer('street_id')->unsigned();
            $table->unsignedInteger('group_id')->nullable();
            $table->dropColumn('title');
            $table->dropColumn('sub-title');
            $table->dropColumn('sport_id');
        });
    }
}
