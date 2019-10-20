<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountModel extends Model
{
    protected $table='discount';
    protected $primaryKey='discount_id';
    protected $fillable=['product_id','purchase_discount','sale_discount','discount_status'];

    public function Validation()
    {
    	return ['product_id'=>'required|unique:discount','purchase_discount'=>'numeric|nullable','sale_discount'=>'numeric|nullable','discount_status'=>'required'];
    }

    public function Validation_edit()
    {
    	return ['product_id'=>'required','purchase_discount'=>'numeric|nullable','sale_discount'=>'numeric|nullable','discount_status'=>'required'];
    }
}
