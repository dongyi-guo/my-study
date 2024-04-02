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
        Schema::create('fee_history', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('feeDateTime');
            $table->unsignedInteger('managerId');
            $table->double('marketFee', $scale = 2)->default(0.00);
            $table->double('adminFee', $scale = 2)->default(0.00);
            $table->double('taxRate', $scale = 2)->default(0.00);
            $table->foreign('managerId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_histories');
    }
};
