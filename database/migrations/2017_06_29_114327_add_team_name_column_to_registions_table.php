<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamNameColumnToRegistionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registions', function (Blueprint $table) {
            $table->string('team_name')->nullable()->after('idcard_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registions', function (Blueprint $table) {
            $table->dropColumn('team_name');
        });
    }
}
