<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale', function (Blueprint $table) {
            $table->bigIncrements('sale_id');
            $table->string('sale_invoice_code');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->string('product_code');
            $table->integer('sale_quantity');
            $table->integer('sale_unit_price');
            $table->integer('sale_vat');
            $table->string('sale_vat_amount');
            $table->integer('sale_discount');
            $table->string('sale_discount_amount');
            $table->string('sale_sub_total');
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
        Schema::dropIfExists('sale');
    }
}
