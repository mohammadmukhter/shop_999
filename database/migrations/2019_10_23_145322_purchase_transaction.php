<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchaseTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_transaction', function (Blueprint $table) {
            $table->bigIncrements('purchase_transaction_id');
            $table->string('purchase_voucher_code');
            $table->string('purchase_total_price');
            $table->string('total_purchase_discount')->nullable();
            $table->string('total_purchase_vat')->nullable();
            $table->string('purchase_net_price');
            $table->integer('purchase_payment_method');
            $table->string('purchase_paid');
            $table->string('purchase_due')->nullable();
            $table->string('purchase_change')->nullable();
            $table->integer('purchase_transaction_status');
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
        Schema::dropIfExists('purchase_transaction');
    }
}
