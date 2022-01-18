<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->string('room_id')->nullable();
            $table->foreignId('tutor_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->integer('time_taken')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->enum('status', ['0', '1', '2'])->default(0)->comment('0. No state 1. Started 2. Ended');
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
        Schema::dropIfExists('meeting_sessions');
    }
}
