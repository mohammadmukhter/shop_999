<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table='customer';
    protected $primaryKey='customer_id';
    protected $fillable=['customer_name','customer_phone','customer_email','customer_address','customer_status','image'];	

    public function Validation()
    {
    	return ['customer_name'=>'required','customer_phone'=>'required|numeric','customer_email'=>'required|email','customer_address'=>'required','customer_status'=>'required','image'=>'mimes:jpg,jpeg,png'];
    }
}
