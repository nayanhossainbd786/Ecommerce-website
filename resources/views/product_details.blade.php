@extends('layouts.frontendmain')
@section('frontend_content')

  <div class="page-info-section page-info">
  		<div class="container">
  			<div class="site-breadcrumb">
  				<a href="{{ url('/') }}">Home</a> /
  				<span>{{ $product_info ->product_name}}</span>
  			</div>
  			<img src=" {{ url('frontend_assets/img/page-info-art.png') }} " alt="" class="page-info-art">
  		</div>
  	</div>
  	<!-- Page Info end -->


  	<!-- Page -->
  	<div class="page-area product-page spad">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-6">
  					<figure>
  						<img class="product-big-img" src=" {{ asset('uploads/product_images') }}/{{$product_info->product_image}}" alt="">
  					</figure>
  					<div class="product-thumbs">
  						<div class="product-thumbs-track">
  							<div class="pt" data-imgbigurl="{{ url('frontend_assets/img/product/1.jpg') }}img/product/1.jpg"><img src="{{ url('frontend_assets/img/product/thumb-1.jpg') }}" alt=""></div>
  							<div class="pt" data-imgbigurl="{{ url('frontend_assets/img/product/2.jpg') }}img/product/2.jpg"><img src="{{ url('frontend_assets/img/product/thumb-2.jpg') }}" alt=""></div>
  							<div class="pt" data-imgbigurl="{{ url('frontend_assets/img/product/3.jpg') }}img/product/3.jpg"><img src="{{ url('frontend_assets/img/product/thumb-3.jpg') }}" alt=""></div>
  							<div class="pt" data-imgbigurl="{{ url('frontend_assets/img/product/4.jpg') }}img/product/4.jpg"><img src="{{ url('frontend_assets/img/product/thumb-4.jpg') }}" alt=""></div>
  						</div>
  					</div>
  				</div>
  				<div class="col-lg-6">
  					<div class="product-content">
  						<h2>{{ $product_info ->product_name}}</h2>
  						<div class="pc-meta">
  							<h4 class="price">${{ $product_info ->product_price}}</h4>
  							<div class="review">
  								<div class="rating">

                    @php
                    if (App\Review::where('product_id',$product_info->id)->exists()) {
                      $final_rating= App\Review::where('product_id',$product_info->id)->sum('rating')/App\Review::where('product_id',$product_info->id)->count();
                    }else {
                      $final_rating=0;
                    }
                    @endphp
                    @if ($final_rating==1)
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star is-fade"></i>
                      <i class="fa fa-star is-fade"></i>
                      <i class="fa fa-star is-fade"></i>
                      <i class="fa fa-star is-fade"></i>
                    @elseif ($final_rating==2)
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star is-fade"></i>
                      <i class="fa fa-star is-fade"></i>
                      <i class="fa fa-star is-fade"></i>
                    @elseif ($final_rating==3)
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star is-fade"></i>
                      <i class="fa fa-star is-fade"></i>
                    @elseif ($final_rating==4)
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>

                      <i class="fa fa-star is-fade"></i>
                    @elseif ($final_rating==5)
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    @endif
  								</div>
  								<span>({{ App\Review::where('product_id',$product_info->id)->count() }} reviews)</span>
  							</div>
  						</div>
  						<p>{{ $product_info ->product_description}}</p>
              @if ($product_info ->product_quantity >=1)
                <a href="{{ url('add/to/cart') }}/{{ $product_info->id }}" class="site-btn btn-line">ADD TO CART</a>
              @else
                <div class=" col-4 alert alert-danger text-center">
                  Product Stock Out!
                </div>
              @endif
  					</div>
  				</div>
  			</div>
  			<div class="product-details">
  				<div class="row">
  					<div class="col-lg-10 offset-lg-1">
  						<ul class="nav" role="tablist">
  							<li class="nav-item">
  								<a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Description</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Additional information</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link" id="3-tab" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Reviews ({{ App\Review::where('product_id',$product_info->id)->count() }})</a>
  							</li>
  						</ul>
  						<div class="tab-content">
  							<!-- single tab content -->
  							<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
  								<p>{{ $product_info ->product_description}}</p>
  							</div>
  							<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
  								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
  							</div>
  							<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                  @php
                    $reviews= App\Review::where('product_id',$product_info->id)->get();
                  @endphp
                  @foreach ($reviews as $review)
                    <ul style="list-style:none">
                      <li >{{ $review->comment }} by  <b>{{ App\User::find($review->user_id)->name  }}</b>
                      </li>
                    </ul>

                  @endforeach
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="text-center rp-title">
  				<h5>Related products</h5>
  			</div>
  			<div class="row">
          @foreach ($related_products as $related_product )
            <div class="col-lg-3">
              <div class="product-item">
                <figure>
                  <img src=" {{ asset('uploads/product_images') }}/{{$related_product->product_image}} " alt="">
                  <div class="pi-meta">
                    <a href="{{ url('product/details') }}/{{ $related_product->id }}">
                      <div class="pi-m-left">
                        <img src="{{ url('frontend_assets/img/icons/eye.png') }}" alt="">
                        <p>quick view</p>
                      </a>
                    </div>
                    <div class="pi-m-right">
                      <img src="{{ url('frontend_assets/img/icons/heart.png') }}" alt="">
                      <p>save</p>
                    </div>
                  </div>
                </figure>
                <div class="product-info">
                  <h6>{{$related_product->product_name}}</h6>
                  <p>${{$related_product->product_price}}</p>
                  <a href="{{ url('add/to/cart') }}/{{ $related_product->id }}" class="site-btn btn-line">ADD TO CART</a>
                </div>
              </div>
            </div>
          @endforeach


  			</div>
  		</div>
  	</div>
  	<!-- Page end -->



@endsection
