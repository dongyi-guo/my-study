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
        Schema::create('energy_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('feeId');
            $table->unsignedInteger('buyerId');
            $table->unsignedInteger('sellerId');
            $table->unsignedInteger('energyTypeId');
            $table->unsignedInteger('zoneId');
            $table->dateTime('transactionDateTime');
            $table->double('volume', $scale = 2)->default(0.00);
            $table->double('tax', $scale = 2)->default(0.00);
            $table->double('tradingPrice', $scale = 2)->default(0.00);
            $table->double('sellerReceivedPrice', $scale = 2)->default(0.00);
            $table->foreign('feeId')->references('id')->on('fee_history');
            $table->foreign('buyerId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sellerId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('energyTypeId')->references('id')->on('energy_types')->onDelete('cascade');
            $table->foreign('zoneId')->references('id')->on('zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('energy_transactions');
    }
};
