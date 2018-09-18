<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeIdsToBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('accommodation_types')->onDelete('set null');

            $table->unsignedInteger('camping_type_id')->nullable();
            $table->foreign('camping_type_id')->references('id')->on('accommodation_subtypes')->onDelete('set null');

            $table->unsignedInteger('chalet_type_id')->nullable();
            $table->foreign('chalet_type_id')->references('id')->on('accommodation_subtypes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('type_id');
            $table->dropColumn('type_id');
            $table->dropForeign('camping_type_id');
            $table->dropColumn('camping_type_id');
            $table->dropForeign('chalet_type_id');
            $table->dropColumn('chalet_type_id');
        });
    }
}
