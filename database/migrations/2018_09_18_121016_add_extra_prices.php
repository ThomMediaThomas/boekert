<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_prices', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date_from');
            $table->date('date_to');

            $table->unsignedInteger('extra_id')->nullable();
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('set null');

            $table->decimal('price');
            $table->boolean('price_night')->default(true);
            $table->boolean('price_stay')->default(false);

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
        Schema::dropIfExists('extra_prices');
    }
}
