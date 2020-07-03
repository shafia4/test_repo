<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInhereracessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inhereracesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('inherer_id');
            $table->integer('acessed');
            $table->integer('useremailsent');
            $table->integer('approved');
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
        Schema::dropIfExists('inhereracesses');
    }
}
