<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInherersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inherers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('is_active')->default('0');
            $table->integer('user_id');
            $table->string('name');
            $table->string('prename')->nullable();
            $table->string('email');
            $table->string('telnr')->nullable();
            $table->string('passcode')->unique()->nullable();
            $table->string('graceperiod');
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('inherers');
    }
}
