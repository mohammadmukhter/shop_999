<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleModel extends Model
{
    protected $table='sale';
    protected $primaryKey='sale_id';
    protected $fillable=['sale_invoice_code','customer_id','product_id','product_code','sale_quantity','sale_unit_price','sale_vat','sale_vat_amount','sale_discount','sale_discount_amount','sale_sub_total'];

    public function Validation()
    {
    	return [
    		
    		'customer_id'=>'required',
    		'product_id'=>'required',
    		'product_code'=>'required',
    		'sale_quantity'=>'required',
    		'sale_unit_price'=>'required',
    		'sale_vat'=>'required',
    		'sale_vat_amount'=>'required',
    		'sale_discount'=>'required',
    		'sale_discount_amount'=>'required',
    		'sale_sub_total'=>'required',
    	];
    }
}
