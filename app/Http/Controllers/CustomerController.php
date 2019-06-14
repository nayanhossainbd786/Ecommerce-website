<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Sale;
use App\Billing_detail;
use App\Product;
use App\Review;
use Carbon\Carbon;
use Auth;


class CustomerController extends Controller
{
      function customer(){
        $total_sales= Sale::where('user_id',Auth::id())->count();
        $total_orders= Sale::where('user_id',Auth::id())->get();
          return view('customer/dashboard',compact('total_sales','total_orders'));
      }
      function customerprofile(){
        return view('customer/profile');
      }
      function customerinfoinsert(Request $request)
      {
        Profile::insert([

          'user_id'=>Auth::id(),
          'first_name'=>$request->first_name,
          'last_name'=>$request->last_name,
          'address'=>$request->address,
          'phone_number'=>$request->phone_number,
          'zip_code'=>$request->zip_code,
          'created_at'=>Carbon::now(),
        ]);
        return back()->with('status','Data insert Successfully!');
      }
      function customerinfoupdate(Request $request)
      {
      Profile::where('user_id', Auth::id())->update([
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'address'=>$request->address,
        'phone_number'=>$request->phone_number,
        'zip_code'=>$request->zip_code,
      ]);
      return back()->with('status','Data Updated Successfully!');
      }
      function customerproductinfo($sale_id){
      $products= Billing_detail::where('sale_id',$sale_id)->get();
      return view('customer/details',compact('products'));

      }
      public function customerproductreviews($billing_id)
      {
          return view('customer/review',compact('billing_id'));

      }
      public function productreviews(Request $request)
      {
        Review::insert([
          'billing_id'=>$request->billing_id,
          'user_id'=>Auth::user()->id,
          'product_id'=>$request->product_id,
          'comment'=>$request->comment,
          'rating'=>$request->rating,
          'created_at'=>Carbon::now()
        ]);
      return back();
      }
}
