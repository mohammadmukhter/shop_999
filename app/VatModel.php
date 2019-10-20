<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VatModel extends Model
{
    protected $table='vat';
    protected $primaryKey='vat_id';
    protected $fillable=['product_id','purchase_vat','sale_vat','vat_status'];

    public function Validation()
    {
    	return ['product_id'=>'required|unique:vat','purchase_vat'=>'numeric|nullable','sale_vat'=>'numeric|nullable','vat_status'=>'required'];
    }

    public function Validation_edit()
    {
    	return ['product_id'=>'required','purchase_vat'=>'numeric|nullable','sale_vat'=>'numeric|nullable','vat_status'=>'required'];
    }
    	
}
