<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  function relationwithProduct(){
          return $this->hasOne('App\Product', 'id','product_id');
  }
}
