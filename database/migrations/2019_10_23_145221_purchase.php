<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Purchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->bigIncrements('purchase_id');
            $table->integer('supplier_id');
            $table->string('purchase_voucher_code');
            $table->integer('product_id');
            $table->string('purchase_unit_price');
            $table->integer('purchase_quantity');
            $table->date('production_date');
            $table->date('expired_date');
            $table->integer('purchase_vat')->nullable();
            $table->integer('purchase_discount')->nullable();
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
        Schema::dropIfExists('purchase');
    }
}
