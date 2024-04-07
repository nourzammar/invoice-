<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardProductesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_productes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('cards');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('productes');
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
        Schema::dropIfExists('card_productes');
    }
}
