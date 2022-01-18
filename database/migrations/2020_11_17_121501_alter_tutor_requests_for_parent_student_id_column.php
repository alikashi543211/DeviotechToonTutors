<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTutorRequestsForParentStudentIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_requests', function (Blueprint $table) {
            $table->foreignId('parent_student_id')->nullable()->after('tutor_id')->references('id')->on('parent_students')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutor_requests', function (Blueprint $table) {
            //
        });
    }
}
