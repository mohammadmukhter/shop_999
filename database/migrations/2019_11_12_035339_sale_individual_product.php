<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SaleIndividualProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_individual_product', function (Blueprint $table) {
            $table->bigIncrements('sale_individual_product_id');
            $table->string('sale_invoice_code');
            $table->integer('stock_id');
            $table->string('stock_code');
            $table->integer('product_id');
            $table->string('product_code');
            $table->integer('sale_individual_product_status')->comment('1=sold, 0=returned ');
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
        Schema::dropIfExists('sale_individual_product');
    }
}
