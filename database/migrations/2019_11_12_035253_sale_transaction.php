<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SaleTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_transaction', function (Blueprint $table) {
            $table->bigIncrements('sale_transaction_id');
            $table->integer('customer_id');
            $table->string('sale_invoice_code');
            $table->string('sale_total_price');
            $table->string('total_sale_discount');
            $table->string('total_sale_vat');
            $table->string('sale_net_price');
            $table->integer('sale_payment_method');
            $table->integer('sale_paid');
            $table->string('sale_due');
            $table->string('sale_change');
            $table->integer('sale_transaction_status')->comment('1=paid, 0=due');
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
        Schema::dropIfExists('sale_transaction');
    }
}
