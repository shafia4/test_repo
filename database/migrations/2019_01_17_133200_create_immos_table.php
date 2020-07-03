<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id');
            $table->date('purchasedate')->nullable();
            $table->string('street')->nullable();
            $table->integer('zipcode')->nullable();
            $table->integer('geolocation')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('rented')->nullable();
            $table->integer('yearlyincome')->nullable();
            $table->integer('yearlycost')->nullable();
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
        Schema::dropIfExists('immos');
    }
}
