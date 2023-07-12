<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_destinations', function (Blueprint $table) {
            $table->foreignId("type_tour_id")->constrained("type_tours", "id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_destinations', function (Blueprint $table) {
            $table->dropColumn('type_tour_id');
        });
    }
};
