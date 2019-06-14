<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Product;
use App\Category;
use App\Slider;
use Image;

class ProductController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('rolechecker');
  }


    function productaddview(){
      $categories=Category::all();
      $products= Product::paginate(10);
      return view('product/add',compact('products', 'categories'));

    }
    function productaddinsert(Request $request){

                  $request->validate([
                    'product_name'=> 'required',
                    'category_id'=> 'required',
                    'product_description'=> 'required',
                    'product_price'=> 'required|numeric',
                    'product_quantity'=> 'required|numeric',
                    'product_image'=> 'image|mimes:jpeg,jpg,png|max:2048',
                    'alert_quantity'=> 'required|numeric'
                  ],
                    [
                      'category_id.required'=>'Category  Must Need!',
                      'product_name.required'=>'Product Name Must Need!',
                      'product_description.required'=>'Product Description Must Need!',
                      'product_price.required'=>'Product Price Must Need!',
                      'product_quantity.required'=>'Product Quantity Must Need!',
                      'product_image.image'=>'Product image Must Need!',
                      'alert_quantity.required'=>'Alert Quantity Must Need!',

      ]);

      $inserted_id=Product::insertGetId([
                      'category_id' => $request->category_id,
                      'product_name' => $request->product_name,
                      'product_description' => $request->product_description,
                      'product_price' => $request->product_price,
                      'product_quantity' => $request->product_quantity,
                      'alert_quantity' => $request->alert_quantity,
                      'created_at' => Carbon::now()
                    ]);
                    if($request->hasFile('product_image')){
                      $image_data=$request->product_image;
                      $extension= $image_data->getClientOriginalExtension();
                      $image_name=$inserted_id.".".$extension;
                        Image::make($image_data)->resize(786,646)->save(base_path('public/uploads/product_images/'.$image_name));
                        Product::find($inserted_id)->update([
                          'product_image'=>$image_name
                        ]);
                    }

      return back()->with('status', 'Product Added Successfully!');
    }

    function productdelete($product_id){
                            Product::find($product_id)->delete();

                            return back()->with('status', 'Product Deleted Successfully!');
    }
    function productedit($product_id){
                              $product_info= Product::findOrFail($product_id);
                              $category_id=Category::all();
                              return view('product/edit',compact('product_info','category_id'));
    }
    function producteditview(Request $request){
                                        $request->validate([
                                          'product_name'=> 'required',
                                          'product_description'=> 'required',
                                          'product_price'=> 'required|numeric',
                                          'product_quantity'=> 'required|numeric',
                                          'alert_quantity'=> 'required|numeric'
                                        ],
                                          [
                                             'product_name.required'=>'Product Name Must Need!',
                                            'product_description.required'=>'Product Description Must Need!',
                                            'product_price.required'=>'Product Price Must Need!',
                                            'product_quantity.required'=>'Product Quantity Must Need!',
                                            'alert_quantity.required'=>'Alert Quantity Must Need!',



                                        ]);
                                        Product::find($request->product_id)->update([
                                          'category_id' => $request->category_id,
                                          'product_name' => $request->product_name,
                                          'product_description' => $request->product_description,
                                          'product_price' => $request->product_price,
                                          'product_quantity' => $request->product_quantity,
                                          'alert_quantity' => $request->alert_quantity,
                                          ]);
                                          if($request->hasFile('product_image')){
                                            $imgname=Product::find($request->product_id)->product_image;
                                            if($imgname !='defaultimage.jpg'){
                                              unlink(base_path('public/uploads/product_images/'.$imgname));
                                                  }
                                            $image_data=$request->product_image;
                                            $extension= $image_data->getClientOriginalExtension();
                                            $image_name=$request->product_id.".".$extension;
                                              Image::make($image_data)->resize(605,406)->save(base_path('public/uploads/product_images/'.$imgname));
                                              Product::find($request->product_id)->update([
                                                'product_image'=>$image_name
                                              ]);
                                        return back()->with('status','Product Edited Successfully!');
                                      }
                                    }
                    function productslideradd(){
                                        return view('product/slider');

                                    }
                    function productsliderinsert(Request $request){
                      $request->validate([
                        'slider_name'=> 'required',

                        'slider_image'=> 'image|mimes:jpeg,jpg,png|max:2048',

                      ],
                        [
                          'slider_name.required'=>'Slider Name  Must Need!',

                          'slider_image.image'=>'Slider image Must Need!',
                      ]);

                      $sliderinsertid=Slider::insertGetId([
                        'slider_name' => $request->slider_name,

                        'created_at' => Carbon::now(),
                      ]);
                      if($request->hasFile('slider_image')){
                        $image_data=$request->slider_image;
                        $extension= $image_data->getClientOriginalExtension();
                        $image_name=$sliderinsertid.".".$extension;
                          Image::make($image_data)->resize(1036,846)->save(base_path('public/uploads/sliders/'.$image_name));
                          Slider::find($sliderinsertid)->update([
                            'slider_image'=>$image_name
                          ]);
                      }
                      return back()->with('status','Slider added Successfully!');
                    }
}
