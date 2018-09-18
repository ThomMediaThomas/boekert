<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccommodationPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_prices', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date_from');
            $table->date('date_to');

            $table->unsignedInteger('accommodation_subtype_id')->nullable();
            $table->foreign('accommodation_subtype_id')->references('id')->on('accommodation_subtypes')->onDelete('set null');

            $table->decimal('price');
            $table->decimal('price_adult');
            $table->decimal('price_child');

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
        Schema::dropIfExists('accommodation_prices');
    }
}
