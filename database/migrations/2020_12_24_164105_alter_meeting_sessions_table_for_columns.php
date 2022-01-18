<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMeetingSessionsTableForColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meeting_sessions', function (Blueprint $table) {
            $table->dropColumn('session_id');
            $table->dropColumn('room_id');
            $table->text('start_url')->after('id');
            $table->text('join_url')->after('start_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meeting_sessions', function (Blueprint $table) {
            //
        });
    }
}
