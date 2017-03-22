<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatchInfoInTicketSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_sports', function (Blueprint $table) {
            $table->string('video')->nullable();
            $table->string('honour')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_sports', function (Blueprint $table) {
            $table->dropColumn('video');
            $table->dropColumn('honour');
        });
    }
}
