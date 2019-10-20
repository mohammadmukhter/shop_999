<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    protected $table='supplier';
    protected $primaryKey='supplier_id';
    protected $fillable=['supplier_name','company_name','supplier_email','supplier_phone','supplier_address','supplier_status','image'];

    public function Validation()
    {
    	return ['supplier_name'=>'required','company_name'=>'required','supplier_email'=>'required|email','supplier_phone'=>'required|numeric','supplier_address'=>'required','supplier_status'=>'required','image'=>'mimes:jpg,jpeg,png'];
    }
}
