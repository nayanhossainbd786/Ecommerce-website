@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3 mt-3">
        <div class="card">
          <div class="card-header bg-info">
            Add New Slider
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

            <form action="{{ url('product/slider/insert') }}" method="post" enctype="multipart/form-data">
                @csrf

              <div class="form-group">
                  <label >Slider Name</label>
                  <input type="text"name="slider_name" class="form-control" placeholder="Enter slider Name" value="{{ old('product_name') }}">
              </div>
            

              <div class="form-group">
                <label >Slider Image</label>
                <input type="file" name="slider_image" class="form-control">
              </div>
              <button type="submit" class="btn btn-success">Add Product</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
