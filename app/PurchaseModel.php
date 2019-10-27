<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseModel extends Model
{
    protected $table='purchase';
    protected $primaryKey='purchase_id';
    protected $fillable=['supplier_id','purchase_voucher_code','product_id','product_code','purchase_unit_price','purchase_quantity','production_date','expired_date','purchase_vat','purchase_vat_amount','purchase_discount','purchase_discount_amount','purchase_sub_total'];

    public function Validation()
    {
    	return ['supplier_id'=>'required','purchase_voucher_code'=>'required','product_id'=>'required','product_code'=>'required','purchase_unit_price'=>'required','purchase_quantity'=>'required','production_date.*'=>'required|date','expired_date.*'=>'required|date','purchase_vat.*'=>'nullable|numeric','purchase_vat_amount.*'=>'nullable','purchase_discount.*'=>'nullable|numeric','purchase_discount_amount.*'=>'nullable','purchase_sub_total'=>'required'];
    }
}
