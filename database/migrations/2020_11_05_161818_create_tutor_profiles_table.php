<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('video_url')->nullable();
            $table->string('dob')->nullable();
            $table->string('subjects')->nullable();
            $table->string('criminal_record')->nullable();
            $table->string('cover_letter')->nullable();
            $table->string('resume')->nullable();
            $table->string('grade_sheet')->nullable();
            $table->string('ref_letter')->nullable();
            $table->boolean('currently_enrolled')->nullable()->default(0);
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('tutor_profiles');
    }
}
