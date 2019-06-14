<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;
class CouponController extends Controller
{     public function __construct(){
      $this->middleware('auth');
      $this->middleware('rolechecker');
      }

    function index() {
      $coupons=Coupon::paginate(5);
      return view('coupon.view', compact('coupons'));
    }
    function addcoupon(Request $request){
        $request->validate([
            'coupon_name'=>'unique:coupons,coupon_name',
            'discount_amount'=>'numeric|max:99',
        ]);
        Coupon::insert([
          'coupon_name'=>$request->coupon_name,
          'discount_amount'=>$request->discount_amount,
          'valid_till'=>$request->valid_till,
          'created_at'=>Carbon::now()
        ]);
        return back()->with('status','Coupon Added Successfully!');
    }
}
