@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8 mt-3">
        <div class="card">
          <div class="card-header bg-info">
            Product List
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">S I</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Category </th>
                  <th scope="col"> Price</th>
                  <th scope="col"> Quantity</th>
                  <th scope="col">Alert Qnty</th>
                  <th scope="col"> Image</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($products as $product)
                <tr>
                  <td>{{$loop->index+1}}</td>

                  <td>{{$product->product_name}}</td>
                  <td>{{$product->relationwithCategory->category_name}}</td>
                  {{-- <td>{{App\Category::find($product->category_id)->category_name}}</td> --}}
                  {{-- <td>{{ substr($product->product_description,0,20) }}</td> --}}
                  <td>{{$product->product_price}}</td>
                  <td>{{$product->product_quantity}}</td>
                  <td>{{$product->alert_quantity}}</td>
                  <td>
                    <img src="{{ asset('uploads/product_images') }}/{{$product->product_image}}" alt="Not found!" width="100">
                  </td>
                  <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="{{ url('product/edit') }}/{{$product->id}}" type="button" class="btn btn-info btn-sm">Edit</a>
                          <a href="{{ url('product/delete') }}/{{$product->id}}"type="button" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                  </td>
                </tr>
              @empty
                <tr class="text-center text-danger ">
                  <td colspan="6">There is No Product To show!</td>
                </tr>
              @endforelse
              </tbody>
            </table>
            {{ $products->links() }}
          </div>
        </div>
      </div>
      <div class="col-4 mt-3">
        <div class="card">
          <div class="card-header bg-info">
            Add New Product
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

            <form action="{{ url('product/add/insert') }}" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label >Category Name</label>
                    <select class="form-control" name="category_id">
                      <option value="">--Select One--</option>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                      @endforeach
                    </select>
                  </div>
              <div class="form-group">
                  <label >Product Name</label>
                  <input type="text"name="product_name" class="form-control" placeholder="Enter Product Name" value="{{ old('product_name') }}">
              </div>
              <div class="form-group">
                  <label >Product Description</label>
                <textarea name="product_description" class="form-control" rows="3" >{{ old('product_description') }}</textarea>
              </div>
              <div class="form-group">
                  <label >Product Price</label>
                  <input type="text"name="product_price" class="form-control" placeholder="Enter Product Price" value="{{ old('product_price') }}">
              </div>
              <div class="form-group">
                <label >Product Quantity</label>
                <input type="text" name="product_quantity" class="form-control" placeholder="Enter Product Quantity"value="{{ old('product_quantity') }}">
              </div>
              <div class="form-group">
                <label >Alert Quantity</label>
                <input type="text"name="alert_quantity" class="form-control" placeholder="Enter Alert Quantity"value="{{ old('alert_quantity') }}">
              </div>
              <div class="form-group">
                <label >Product Image</label>
                <input type="file" name="product_image" class="form-control">
              </div>
              <button type="submit" class="btn btn-success">Add Product</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
