<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('boekert_id');

            $table->date('date_from');
            $table->date('date_to');

            $table->enum('type', ['chalet', 'camping']);
            $table->enum('chalet_type', ['chalet-4', 'chalet-6'])->nullable();
            $table->enum('camping_type', ['tent', 'folding_car', 'camper', 'caravan', 'other'])->nullable();

            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');

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
        Schema::dropIfExists('bookings');
    }
}
