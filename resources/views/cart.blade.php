@extends('layouts.frontendmain')
@section('frontend_content')
            <!-- Page Info -->
            	<div class="page-info-section page-info">
            		<div class="container">
            			<div class="site-breadcrumb">
            				<a href="{{ url('/home') }}">Home</a> /
              				<span>Cart</span>
            			</div>
            			<img src="{{ asset('frontend_assets/img/page-info-art.png') }} " alt="" class="page-info-art">
            		</div>
            	</div>
            	<!-- Page Info end -->
              <!-- Page -->
          	<div class="page-area cart-page spad">
          		<div class="container">
                @if (session('success'))
                  <div class="alert alert-success ">
                    {{ session('success') }}
                  </div>
                @endif
                @if (session('success_cod'))
                  <div class="alert alert-success ">
                    {{ session('success_cod') }}
                  </div>
                @endif
                <form  action="{{ url('update/cart') }}" method="post">
                  @csrf
                    <div class="cart-table">
                      <table>
                        <thead>
                          <tr>
                            <th class="product-th">Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="total-th">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                          $sub_total=0;
                          @endphp
                          @forelse ($added_products as $added_product)
                            <tr>
                              <td class="product-col">
                                <img src="{{ asset('uploads/product_images') }}/{{ $added_product->relationwithProduct->product_image }}" alt="">
                                <div class="pc-title">
                                  <h4>{{ $added_product->relationwithProduct->product_name }}</h4>
                                  <a class="btn btn-danger" href="{{ url('added/item/remove') }}/{{ $added_product->id }}">Remove</a>
                                </div>
                              </td>
                              <td class="price-col">${{ $added_product->relationwithProduct->product_price }}</td>
                              <td class="quy-col">
                                <div class="quy-input">
                                  <span>Qty</span>
                                  <input name="product_id[]" type="hidden" value="{{ $added_product->product_id }}">
                                  <input name="qnty[]" type="number" value="{{ $added_product->quantities }}">
                                </div>
                              </td>
                              <td class="total-col">${{ $added_product->relationwithProduct->product_price *$added_product->quantities }}
                                @php
                                $sub_total=$sub_total+($added_product->relationwithProduct->product_price *$added_product->quantities);
                                @endphp
                              </td>
                            </tr>
                          @empty
                            <tr class="text-center text-danger">
                              <td colspan="4">No Added Items Found!</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>

                    </div>
                    <div class="row cart-buttons">
                      <div class="col-lg-5 col-md-5">
                        <a href="{{ url('/') }}" class="site-btn btn-continue">Continue shopping</a >
                        </div>
                        <div class="col-lg-7 col-md-7 text-lg-right text-left">
                          <a href="{{ url('clear/cart') }}"class="site-btn btn-clear">Clear cart</a>
                          <button type="submit" class="site-btn btn-line btn-update">Update Cart</button>
                        </div>
                </form>
          			</div>
          		</div>
          		<div class="card-warp">
          			<div class="container">
          				<div class="row">
          					<div class="col-lg-4">
          						<div class="shipping-info">
          							<h4>Shipping method</h4>
          							<p>Select the one you want</p>
          							<div class="shipping-chooes">
          								<div class="sc-item">
          									<input type="radio" name="sc" id="one">
          									<label for="one"id="lebel_one">Next day delivery<span>$4.99</span></label>
          								</div>
          								<div class="sc-item">
          									<input type="radio" name="sc" id="two">
          									<label for="two"id="lebel_two">Standard delivery<span>$1.99</span></label>
          								</div>
          								<div class="sc-item">
          									<input type="radio" name="sc" id="three">
          									<label for="three" id="lebel_three">Personal Pickup<span>Free</span></label>
          								</div>
          							</div>
          							<h4>Cupon code</h4>
                        @if (session('status'))
                          <div  class="alert alert-danger">
                            {{ session('status') }}
                          </div>
                        @endif
          							<div class="cupon-input">
          								<input type="text"  id="user_inserted_coupon_name" value="{{ $coupon_name }}">
          								<button class="site-btn" id="apply_coupon_btn">Apply</button>
          							</div>
          						</div>
          					</div>
          					<div class="offset-lg-2 col-lg-6">
          						<div class="cart-total-details">
          							<h4>Cart total</h4>
          							<p>Final Info</p>
          							<ul class="cart-total-card">
          								<li>Price<span>${{$sub_total}}</span></li>
          								<li>Discount Amount(%)<span>{{ $coupon_discount_amount }}%</span></li>
          								<li>Shipping<span id="shipping_amount">0</span><span>$</span></li>
          							<span style="display:none" id="grand_total">{{$total= $sub_total-($sub_total*($coupon_discount_amount/100)) }}</span>
          								<li class="total">Total(With Shipping Charge)<span id="total">{{ $total }}</span><span> $</span></li>
          							</ul>
                        <form class="" action="{{ url('/checkout') }}" method="post">
                          @csrf
                          <input type="hidden" name="total" value="{{ $total }}">
                          <button type="submit" class="site-btn btn-full" >Proceed to checkout</button>
                        </form>
          						</div>
          					</div>
          				</div>
          			</div>
          		</div>
          	</div>
          	<!-- Page end -->

@endsection
@section('footer_scripts')
  <script >
    $(document).ready(function(){
      $('#apply_coupon_btn').click(function(){
        var coupon_name=$('#user_inserted_coupon_name').val();
        window.location.href='{{ url('/cart') }}'+'/'+coupon_name;
      });
      $('#lebel_one').click(function(){
        var lebel_one_value =parseFloat(4.99);
        // alert(lebel_one_value);
        $('#shipping_amount').html(lebel_one_value);
        var grand_total=parseFloat($('#grand_total').html());
        var total=grand_total + lebel_one_value;
        $('#total').html(parseFloat(total).toFixed(2));
      });
      $('#lebel_two').click(function(){
        var lebel_two_value =parseFloat(1.99);
        // alert(lebel_one_value);
        $('#shipping_amount').html(lebel_two_value);
        var grand_total=parseFloat($('#grand_total').html());
        var total=grand_total + lebel_two_value;
        $('#total').html(parseFloat(total).toFixed(2));
      });
      $('#lebel_three').click(function(){
        var lebel_three_value =parseFloat(0);
        // alert(lebel_one_value);
        $('#shipping_amount').html(lebel_three_value);
        var grand_total=parseFloat($('#grand_total').html());
        var total=grand_total + lebel_three_value;
        $('#total').html(parseFloat(total).toFixed(2));
      });
    });
  </script>
@endsection
