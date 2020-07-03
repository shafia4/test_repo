<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assettype_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('assetusage_id')->nullable();
            $table->integer('liability_id')->nullable();
            $table->string('name');
            $table->string('purchasedate')->nullable();
            $table->string('licenseplate')->nullable();
            $table->integer('currency_id');
            $table->integer('milage')->nullable();
            $table->string('serialnr')->nullable();
            $table->string('brand')->nullable();
            $table->string('artist')->nullable();
            $table->integer('value')->nullable();
            $table->integer('initialinvestment')->nullable();
            $table->string('valuebase')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('coordinates')->nullable();
            $table->integer('revenue')->nullable();
            $table->integer('costs')->nullable();
            $table->decimal('interest', 8, 2)->nullable();
            $table->integer('enddate')->nullable();
            $table->integer('term')->nullable();
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
        Schema::dropIfExists('assets');
    }
}
