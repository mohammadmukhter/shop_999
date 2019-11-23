<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleTransactionModel extends Model
{
    protected $table='sale_transaction';
    protected $primaryKey='sale_transaction_id';
    protected $fillable=['customer_id','sale_invoice_code','sale_total_price','total_sale_discount','total_sale_vat','sale_net_total','sale_payment_method','sale_paid','sale_due','sale_change','sale_transaction_status'];

    public function Validation()
    {
    	return [
    		'customer_id'=>'required',
    		'sale_total_price'=>'required',
    		'sale_net_total'=>'required',
    		'sale_payment_method'=>'required',
    		'sale_paid'=>'required',
    	];
    }
}
