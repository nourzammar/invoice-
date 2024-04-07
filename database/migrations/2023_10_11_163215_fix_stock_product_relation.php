<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixStockProductRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productes', function (Blueprint $table) {
            $table->dropForeign('productes_stock_id_foreign');
            $table->dropColumn('stock_id');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('productes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productes', function (Blueprint $table) {
            $table->bigInteger('stock_id')->unsigned();
            $table->foreign('stock_id')->references('id')->on('stocks');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
    }
}
