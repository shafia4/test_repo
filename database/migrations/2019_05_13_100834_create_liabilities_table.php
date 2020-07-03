<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('liabilitytype')->nullable();
            $table->string('name');
            $table->integer('agreementdate')->nullable();
            $table->string('contractnr')->nullable();
            $table->string('licenseplate')->nullable();
            $table->string('creditor')->nullable();
            $table->integer('currency_id')->nullable();
            $table->string('term')->nullable();
            $table->float('currentvalue', 8, 2)->nullable();
            $table->float('initialvalue', 8, 2)->nullable();
            $table->float('interest', 8, 2)->nullable();
            $table->integer('enddate')->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('liabilities');
    }
}
