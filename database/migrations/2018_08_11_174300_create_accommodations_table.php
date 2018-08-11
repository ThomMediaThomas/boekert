<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('field_number');

            $table->enum('type', ['chalet', 'camping']);
            $table->enum('chalet_type', ['chalet-4', 'chalet-6'])->nullable();
            $table->enum('camping_type', ['all', 'tent', 'folding_car', 'camper', 'caravan'])->nullable();

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
        Schema::dropIfExists('accommodations');
    }
}
