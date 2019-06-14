@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('product/add/insert') }}">Edit Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product_info->product_name }}</li>
          </ol>
        </nav>
        <div class="card">
          <div class="card-header bg-info">
            Edit Product
          </div>
          <div class="card-body">
            @if (session('status'))
              <div  class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif

            @if ($errors->all())
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <ul>
                      <li>{{ $error }} </li>
                    </ul>
                  @endforeach
              </div>
            @endif
              <form action="{{ url('product/edit/view') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label >Category Name</label>
                  <select class="form-control" name="category_id">
                    @foreach ($category_id as $category)
                    <option value="{{ $category->id }}" {{ ($product_info->category_id== $category->id)?"selected":"" }}>{{ $category->category_name }}</option>
                  @endforeach

                  </select>

                </div>
              <div class="form-group">
                <label >Product Name</label>
                <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                <input type="text"name="product_name" class="form-control" placeholder="Enter Product Name" value="{{ $product_info->product_name }}">
              </div>
              <div class="form-group">
                <label >Product Description</label>
              <textarea name="product_description" class="form-control" rows="3" >{{  $product_info->product_description  }}</textarea>
              </div>
              <div class="form-group">
                <label >Product Price</label>
                <input type="text"name="product_price" class="form-control" placeholder="Enter Product Price" value="{{ $product_info->product_price }}">
              </div>
              <div class="form-group">
                <label >Product Quantity</label>
                <input type="text" name="product_quantity" class="form-control" placeholder="Enter Product Quantity"value="{{ $product_info->product_quantity }}">
              </div>
              <div class="form-group">
                <label >Alert Quantity</label>
                <input type="text"name="alert_quantity" class="form-control" placeholder="Enter Alert Quantity"value="{{ $product_info->alert_quantity }}">
              </div>
              <div class="form-group">
                <label >Product Image</label>
                <input type="file"name="product_image" class="form-control" >
              </div>
              <button type="submit" class="btn btn-info">Edit Product</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
