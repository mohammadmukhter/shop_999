<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockModel extends Model
{
    protected $table='stock';
    protected $primaryKey='stock_id';
    protected $fillable=['stock_code','purchase_voucher_code','product_id','product_code','stock_status'];

    public function Validation()
    {
    	return ['purchase_voucher_code'=>'required','product_id'=>'required','product_code'=>'required'];
    }
}
