<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    protected $table='unit';
    protected $primaryKey='unit_id';
    protected $fillable=['unit_name','unit_status'];

    public function Validation()
    {
    	return ['unit_name'=>'required','unit_status'=>'required'];
    }
}
