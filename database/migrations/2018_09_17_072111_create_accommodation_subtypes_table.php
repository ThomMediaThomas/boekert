<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationSubtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_subtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('system_name');
            $table->unsignedInteger('parent_type_id')->nullable();
            $table->foreign('parent_type_id')->references('id')->on('accommodation_types')->onDelete('set null');
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
        Schema::dropIfExists('accommodation_subtypes');
    }
}
