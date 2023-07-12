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
        Schema::create('travel_destinations', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->time("open")->nullable();
            $table->time("close")->nullable();
            $table->string("type_ticket");
            $table->foreignId("destination_id")->constrained("destination_packages", "id");
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
        Schema::dropIfExists('travel_destinations');
    }
};
