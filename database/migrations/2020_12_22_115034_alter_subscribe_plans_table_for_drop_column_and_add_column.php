<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSubscribePlansTableForDropColumnAndAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_plans', function (Blueprint $table) {
            $table->dropColumn('remaining_amount');
            $table->dropColumn('package_type');
            $table->foreignId('package_id')->references('id')->on('packages')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_plans', function (Blueprint $table) {
            //
        });
    }
}
