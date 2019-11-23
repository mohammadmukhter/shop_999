<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleIndividualProductModel extends Model
{
    protected $table='sale_individual_product';
    protected $primaryKey='sale_individual_product_id';
    protected $fillable=['sale_invoice_code','stock_id','stock_code','product_id','product_code','sale_individual_product_status'];

    public function Validation()
    {
    	return [
    		'sale_invoice_code'=>'required',
    		'stock_id'=>'required',
    		'stock_code'=>'required',
    		'product_id'=>'required',
    		'product_code'=>'required',
    		'sale_individual_product_status'=>'required',
    	];
    }
}
