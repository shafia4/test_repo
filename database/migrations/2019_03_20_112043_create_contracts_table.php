<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id')->nullable();
            $table->integer('liability_id')->nullable();
            $table->integer('partner_id')->nullable();
            $table->string('name');
            $table->integer('value')->nullable();
            $table->string('storedlocation')->nullable();
            $table->string('path')->nullable();
            $table->integer('agreedon')->nullable();
            $table->integer('termination')->nullable();
            $table->string('reminderterm')->nullable();
            $table->string('reminderreg')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
