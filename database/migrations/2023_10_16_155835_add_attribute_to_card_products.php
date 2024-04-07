<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeToCardProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_productes', function (Blueprint $table) {
            $table->double('price')->nullable();
            $table->double('second_price')->nullable();
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_productes', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('second_price');
            $table->dropColumn('quantity');
        });
    }
}
