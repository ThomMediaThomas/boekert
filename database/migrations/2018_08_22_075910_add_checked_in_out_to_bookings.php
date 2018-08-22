<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckedInOutToBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('checked_in')->nullable()->default(false);
            $table->dateTime('checked_in_at')->nullable();
            $table->boolean('checked_out')->nullable()->default(false);
            $table->dateTime('checked_out_at')->nullable();
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
            $table->dropColumn(['checked_in', 'checked_in_at', 'checked_out', 'checked_out_at']);
        });
    }
}
