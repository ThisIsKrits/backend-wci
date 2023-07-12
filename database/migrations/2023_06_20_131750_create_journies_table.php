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
        Schema::create('journies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tour_package_id")->constrained("tour_packages", "id");
            $table->integer("day");
            $table->string("image");
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
        Schema::dropIfExists('journies');
    }
};
