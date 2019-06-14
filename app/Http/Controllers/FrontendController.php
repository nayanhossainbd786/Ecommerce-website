<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Slider;
use App\Cart;
use App\User;
use App\Coupon;
use App\Country;
use App\City;
use App\Shipping;
use App\Sale;
use App\Billing_detail;
use Carbon\Carbon;
use Auth;
use Session;

class FrontendController extends Controller
{
      function contact(){
        return view('contact');
      }
      function index(){
                  $allproducts= Product::all();
                  $allcategories= Category::all();
                  $allsliders= Slider::all();
                  return view('welcome',compact('allproducts','allcategories', 'allsliders'));
      }
      function categorywiseproduct($category_id){

                    $products=Product::where('category_id',$category_id)->get();
                    return view('categories', compact('products'));
        }

      function productdetails($product_id){

                     $product_info=Product::find($product_id);
                     $related_products=Product::where('category_id',$product_info->category_id)->where('id','!=',$product_id)->get();
                    return view('product_details',compact('product_info','related_products'));
      }
      function addtocart($product_id){
                        $ip=$_SERVER['REMOTE_ADDR'];
                        if(Cart::where('customer_ip',$ip)->where('product_id',$product_id)->exists()){
                                Cart::where('customer_ip',$ip)->where('product_id',$product_id)->increment('quantities');
                                return back();
                        }
                        else{
                                Cart::insert([
                                        'customer_ip'=>$ip ,
                                        'product_id'=>$product_id,
                                        'created_at'=>Carbon::now(),
                                          ]);
                              return back();
                                }


                              }
          function cart($coupon_name=""){
                              if($coupon_name==""){
                                $ip=$_SERVER['REMOTE_ADDR'];
                                $added_products=Cart::where('customer_ip',$ip)->paginate(2);
                                $coupon_discount_amount=0;
                                return view('cart',compact('added_products', 'coupon_discount_amount','coupon_name'));

                              }
                              else {
                                  if (Coupon::where('coupon_name',$coupon_name)->exists()) {
                                  Carbon::now()->format('Y-m-d');
                                  Coupon::where('coupon_name',$coupon_name)->first()->valid_till;
                                if(Carbon::now()->format('Y-m-d')<= Coupon::where('coupon_name',$coupon_name)->first()->valid_till){
                                  $coupon_discount_amount= Coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
                                  $ip=$_SERVER['REMOTE_ADDR'];
                                  $added_products=Cart::where('customer_ip',$ip)->get();
                                return view('cart',compact('added_products','coupon_discount_amount','coupon_name'));
                                }else {
                                  return back()->with('status'," Sorry, This Coupon Validity has expired!");
                                }
                                  }
                                  else {
                                  return back()->with('status',"Please! Enter a valid coupon!");
                                  }
                              }
                          }
          function clearcart(){
                        $ip=$_SERVER['REMOTE_ADDR'];
                        Cart::where('customer_ip',$ip)->delete();
                        return back()->with('new',"Items Delete Successfully!!");
                      }
          function addeditemremove($cart_id){
                    Cart::find($cart_id)->delete();
                  return back()->with('new',"Item removes!");

          }
          function updatecart(Request $request)
          {
            // print_r($request->all());
            foreach ($request->product_id as $key_of_product_id => $value_of_product_id) {
              if(Product::find($value_of_product_id)->product_quantity >= $request->qnty[$key_of_product_id]){
                $ip=$_SERVER['REMOTE_ADDR'];
                      Cart::where('customer_ip',$ip)->where('product_id',$value_of_product_id)->update([
                          'quantities'=> $request->qnty[$key_of_product_id]
                        ]);

              }

            }
              return back();
          }
          function customerregister(){
            return view('customerregister');
          }
          function customerregisterinsert(Request $request){
                    $request->validate([
                        'email'=>'unique:users,email',
                    ]);
                    User::insert([
                      'name'=>$request->name,
                      'email'=>$request->email,
                      'password'=>bcrypt($request->password),
                      'role'=>2,
                    ]);
            return back();
          }
          function checkout(Request $request){
            $total=$request->total;
            $countries=Country::all();
            return view('checkout',compact('countries','total'));
          }
          function citylist(Request $request){
            $cityList ="<option>-Select One-</option>";
             $cities=City::where('country_id',$request->country_id)->get();
            foreach ($cities as $city) {
                $cityList .= "<option value='".$city->id."'>".$city->name."</option>";
            }
            echo $cityList;
          }
          function checkoutinsert(Request $request){
            $request->validate([
              'first_name'=> 'required',
              'last_name'=> 'required',
              'phone_number'=> 'required',
              'address'=> 'required',
              'city_id'=> 'required|numeric',
              'country_id'=> 'required|numeric'
            ]);
              $shipping_id=Shipping::insertGetId([
                'user_id'=>Auth::id(),
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,
                'city_id'=>$request->city_id,
                'country_id'=>$request->country_id,
                'zip_code'=>$request->zip_code,
                'payment_type'=>$request->payment_type,
                'payment_status'=>1,
                'created_at'=>Carbon::now(),
            ]);
          $sale_id = Sale::insertGetId([
            'user_id'=>Auth::id(),
            'shipping_id'=>$shipping_id,
            'total'=>$request->total,
            'created_at'=>Carbon::now(),
          ]);
          $ip= $_SERVER['REMOTE_ADDR'];
          $cart_items= Cart::where('customer_ip',$ip)->get();
          foreach ($cart_items as $cart_item) {
            Billing_detail::insert([
              'sale_id'=>$sale_id,
              'product_id'=>$cart_item->product_id,
              'product_price'=>Product::find($cart_item->product_id)->product_price,
              'quantities'=>$cart_item->quantities,
              'created_at'=>Carbon::now(),
            ]);
            Product::find($cart_item->product_id)->decrement('product_quantity',$cart_item->quantities);
            $cart_item->delete();
            }
            if ($request->payment_type==1) {
              Session::flash('success_cod', 'Order Placed  successfully!');
              return redirect('cart');
            }
            elseif ($request->payment_type==2) {
              $total=$request->total;

                return redirect('stripe')->with('total',$total)->with('shipping_id',$shipping_id);
            }

          }


}
