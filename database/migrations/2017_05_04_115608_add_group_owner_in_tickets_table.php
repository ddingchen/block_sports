<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupOwnerInTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedInteger("owner_id")->after('match_id');
            $table->string("owner_type")->after('owner_id');
            $table->index(["owner_id", "owner_type"]);
        });

        DB::update("update tickets set owner_id = user_id, owner_type = 'App\User'");

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn("user_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('owner_id');
            $table->dropColumn('owner_type');
            $table->unsignedInteger('user_id')->after('match_id');
        });
    }
}
