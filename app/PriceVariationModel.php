<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceVariationModel extends Model
{
    protected $table='price_variation';
    protected $primaryKey='price_variation_id';
    protected $fillable=['product_id','last_purchase_price','last_sale_price'];
}
