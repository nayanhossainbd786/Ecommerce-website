@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8  offset-2">
        <div class="card">
        <div class="card-header">
          Review
        </div>
        <div class="card-body">
          <form  action="{{url('product/review')}}" method="post">
            @csrf
            <input type="hidden" name="billing_id" value="{{ $billing_id }}">
            <input type="hidden" name="product_id" value="{{ App\Billing_detail::find($billing_id)->product_id }}">
            <div class="form-group">
                <label >Write Your Comment</label>
                <textarea class="form-control" name="comment" rows="5" cols="80"></textarea>
            </div>
            <div class="form-group">
                <label >Rate This Product</label>
                <input type="range"name="rating" class="form-control" min='1' max='5'step='1'>
            </div>
            <button type="submit" class="btn  btn-success">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
