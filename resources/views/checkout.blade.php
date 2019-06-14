@extends('layouts.frontendmain')
@section('frontend_content')
  <!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="">Home</a> /
				<a href="">Sales</a> /
				<a href="">Bags</a> /
				<a href="">Cart</a> /
				<span>Checkout</span>
			</div>
			<img src="{{ asset('frontend_assets/img/page-info-art.png') }}" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->

	@if ($errors->all())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
					<ul>
						<li>{{ $error }} </li>
					</ul>
				@endforeach
		</div>
	@endif
	<!-- Page -->
	<div class="page-area cart-page spad">
		<div class="container">
			@auth
				<form class="checkout-form" action="{{ url('checkout/insert') }}" method="post">
					@csrf
					@php
						$singledata=App\Profile::where('user_id',Auth::id())->first();
					@endphp
				<div class="row">

					<div class="col-lg-6">
						<h4 class="checkout-title">Billing Address</h4>
						<div class="row">
							<div class="col-md-6">
								<input type="text" placeholder="First Name *"name="first_name" value="{{ $singledata->first_name }}">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Last Name *"name="last_name" value="{{ $singledata->last_name }}">
							</div>
							<div class="col-md-12">

								<select id="country_id" name="country_id">
									<option>-Select One- *</option>
									@foreach ($countries as $country)
										<option value="{{ $country->id }}">{{ $country->name }}</option>
									@endforeach
								</select >
								<select id="city_id"name="city_id">
									<option >City/Town *</option>
								</select>
								<input type="text" placeholder="Address *" name="address"value="{{ $singledata->address }}">

								<input type="text" placeholder="Zipcode *"name="zip_code" value="{{ $singledata->zip_code }}">

								<input type="text" placeholder="Phone no *"name="phone_number" value="{{ $singledata->phone_number }}">
								<input type="email" placeholder="Email Address *"name="email" value="{{ Auth::user()->email }}">
								<div class="checkbox-items">
									<div class="ci-item">
										<input type="checkbox" name="a" id="tandc">
										<label for="tandc">Terms and conditions</label>
									</div>

									<div class="ci-item">
										<input type="checkbox" name="c" id="newsletter">
										<label for="newsletter">Subscribe to our newsletter</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="order-card">
							<div class="order-details">
								<div class="od-warp">
									<h4 class="checkout-title">Your order</h4>
									<table class="order-table">
										<thead>
											<tr>
												<th>Product</th>
												<th>Total</th>
											</tr>
										</thead>

										<tfoot>
											<tr class="order-total">
												<th>Total</th>
												<input type="hidden" name="total" value="{{$total }}">
												<th>${{$total }}</th>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="payment-method">

									<div class="pm-item">
										<input type="radio" name="payment_type" id="one"value="1" checked>
										<label for="one">Cash on delievery</label>
									</div>
									<div class="pm-item">
										<input type="radio" name="payment_type"value="2" id="two">
										<label for="two">Credit card</label>
									</div>

								</div>
							</div>
							<button class="site-btn btn-full" type="submit">Place Order</button>
						</div>
					</div>
				</div>
			</form>
		@else
			<div class="col-lg-6">
					<h4 class="checkout-title">Please Login <a href="{{ url('login') }}">here..</a> or <a href="{{ url('customer/register') }}">Register </a></h4>
			</div>
			@endauth
		</div>
	</div>
	<!-- Page -->
@endsection
@section('footer_scripts')
	<script>
		$(document).ready(function(){
			$('#country_id').change(function(){
				var country_id =$(this).val();
					$.ajaxSetup({
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
					});
					$.ajax({
	        type:'POST',
	        url:'/city/list',
	        data: {country_id:country_id},
	        success: function (data) {
	          $('#city_id').html(data);
	          }
	        });
      });
		});
	</script>
@endsection
