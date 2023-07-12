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
        Schema::create('ticket_price_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId("adult_id")->constrained("adults", "id");
            $table->integer("normal_price");
            $table->integer("promo_price");
            $table->foreignId("travel_package_id")->constrained("travel_packages", "id");
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
        Schema::dropIfExists('ticket_price_types');
    }
};
