<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTypeEnumsFromAccommodations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('chalet_type');
            $table->dropColumn('camping_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->enum('type', ['chalet', 'camping']);
            $table->enum('chalet_type', ['chalet-4', 'chalet-6'])->nullable();
            $table->enum('camping_type', ['tent', 'folding_car', 'camper', 'caravan', 'other'])->nullable();
        });
    }
}
