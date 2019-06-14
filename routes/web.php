<?php



//Frontend Controller Routing
Route::get('category/add/view','CategoryController@categoryaddview');
Route::post('category/add/insert','CategoryController@categoryaddinsert');
Route::get('category/delete/{category_id}','CategoryController@categorydelete');

Route::get('/home','FrontendController@index');
Route::get('product/details/{product_id}','FrontendController@productdetails');
Route::get('contact','FrontendController@contact');
Route::get('category/wise/product/{category_id}','FrontendController@categorywiseproduct');
Route::get('add/to/cart/{product_id}','FrontendController@addtocart');
Route::get('/cart','FrontendController@cart');
Route::get('/cart/{coupon_name}','FrontendController@cart');
Route::get('clear/cart','FrontendController@clearcart');
Route::get('added/item/remove/{cart_id}','FrontendController@addeditemremove');
Route::post('update/cart','FrontendController@updatecart');
Route::post('checkout','FrontendController@checkout');
Route::post('checkout/insert','FrontendController@checkoutinsert');
Route::post('city/list','FrontendController@citylist');

Route::get('customer/register','FrontendController@customerregister');
Route::post('customer/register/insert','FrontendController@customerregisterinsert');


Route::get('contact','FrontendController@contact');
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//All Backend Routes
Route::get('product/add/view','ProductController@productaddview');
Route::post('product/add/insert','ProductController@productaddinsert');
Route::get('product/delete/{product_id}','ProductController@productdelete');
Route::get('product/edit/{product_id}','ProductController@productedit');
Route::post('product/edit/view','ProductController@producteditview');
Route::get('product/slider/add','ProductController@productslideradd');
Route::post('product/slider/insert','ProductController@productsliderinsert');


Route::get('coupon/add/view','CouponController@index');
Route::post('coupon/add/insert','CouponController@addcoupon');


//Customer Controller Section
Route::get('customer/dashboard','CustomerController@customer');
Route::get('customer/profile','CustomerController@customerprofile');
Route::post('customer/info/insert','CustomerController@customerinfoinsert');
Route::post('customer/info/update','CustomerController@customerinfoupdate');
Route::get('customer/product/info/{sale_id}','CustomerController@customerproductinfo');
Route::get('customer/product/reviews/{billing_id}','CustomerController@customerproductreviews');
Route::post('product/review','CustomerController@productreviews');

//Payment Routes
Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
