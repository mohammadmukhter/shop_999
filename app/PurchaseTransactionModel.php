<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseTransactionModel extends Model
{
    protected $table='purchase_transaction';
    protected $primaryKey='purchase_transaction_id';
    protected $fillable=['supplier_id','purchase_voucher_code','purchase_total_price','total_purchase_discount','total_purchase_vat','purchase_net_price','purchase_payment_method','purchase_paid','purchase_due','purchase_change','purchase_transaction_status'];

    public function Validation()
    {
    	return ['purchase_voucher_code'=>'required','purchase_total_price'=>'required','total_purchase_discount'=>'nullable','total_purchase_vat'=>'nullable','purchase_net_price'=>'required','purchase_payment_method'=>'required','purchase_paid'=>'required','purchase_due'=>'nullable','purchase_change'=>'nullable'];
    }
}
