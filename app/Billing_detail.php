<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sale;

class Billing_detail extends Model
{
  function relationtoSale()
  {
    return $this->hasOne('App\Sale','id','sale_id');
  }
}
