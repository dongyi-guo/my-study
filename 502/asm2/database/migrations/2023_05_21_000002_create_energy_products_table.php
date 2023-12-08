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
        Schema::create('energy_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ownerId');
            $table->unsignedInteger('energyTypeId');
            $table->unsignedInteger('zoneId');
            $table->double('volume', $scale = 2)->default(0.00);
            $table->double('sellerPrice', $scale = 2)->default(0.00);
            $table->foreign('ownerId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('energyTypeId')->references('id')->on('energy_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('energy_products');
    }
};
