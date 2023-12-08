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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tradingPositionId');
            $table->string('userName');
            $table->string('email')->unique();
            $table->boolean('isManager');
            $table->string('passwd');
            $table->boolean('isActive');
            $table->string('postalAddress');
            $table->unsignedInteger('zoneId');
            $table->double('balance', $scale = 2)->default(0.00);
            $table->foreign('tradingPositionId')->references('id')->on('trading_positions');
            $table->foreign('zoneId')->references('id')->on('zones');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
