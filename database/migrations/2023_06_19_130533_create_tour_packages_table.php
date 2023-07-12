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
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("duration");
            $table->foreignId("destination_id")->constrained("destination_packages", "id");
            $table->foreignId("type_tour_id")->constrained("type_tours", "id");
            $table->integer("price");
            $table->integer("promo_price");
            $table->text("desc");
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
        Schema::dropIfExists('tour_packages');
    }
};
