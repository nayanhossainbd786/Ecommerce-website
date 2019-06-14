<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable=['category_id', 'product_name', 'product_description', 'product_price', 'product_quantity', 'alert_quantity','product_image'];

    function relationwithCategory(){
            return $this->hasOne('App\Category', 'id','category_id');
    }
}
