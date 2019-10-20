<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table='product';
    protected $primaryKey='product_id';
    protected $fillable=['product_name','product_code','category_id','sub_category_id','purchase_price','sale_price','unit_id','production_date','expired_date','image','product_status'];

    public function Validation()
    {
    	return ['product_name'=>'required','category_id'=>'required','sub_category_id'=>'required','purchase_price'=>'required|numeric','sale_price'=>'required|numeric','unit_id'=>'required','production_date'=>'required','expired_date'=>'required','image'=>'mimes:jpg,jpeg,png','product_status'=>'required'];
    }

    public function PriceValidation($purchase_price,$sale_price)
    {	
    	if($purchase_price > $sale_price)
    	{
    		return true;
    	}
    	return false;
    }
}
