@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
          <div class="col-3">
                          <!-- Sidebar -->
        <div class="card">
          <div class="card-header bg-secondary">
            {{-- <img src="{{ asset('uploads/sliders/1.jpg') }}" class="imgrounded" alt="No Image"> --}}
          <div class="sidebar-heading ">Menu</div>
          </div>
          <div class="card-body">
            <div class="bg-light border-right" id="sidebar-wrapper">
          <div class="list-group list-group-flush">
            <a href="{{ url('customer/dashboard') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
            <a href="{{ url('customer/profile') }}" class="list-group-item list-group-item-action bg-light">Profile</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
          </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-8">
        <section>
          <div class="">
        <div class="card">
        <div class="card-header">
          Orders List
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th>id</th>
              <th>Product Name</th>
              <th>Product Image</th>
              <th>Product Quantity</th>
              <th>Product Price</th>
              <th>Action</th>
            </tr>

            @foreach ($products as $product)
              <tr>

                <td>
                  {{-- {{ $data->product_name }} --}}
                  {{ $product->id }}
                </td>
                <td>
                  {{ App\Product::where('id',$product->product_id)->first()->product_name }}
                </td>
                <td>
                  <img src="{{ url('uploads/product_images') }}/{{ App\Product::where('id',$product->product_id)->first()->product_image }}" alt="" width="100px">
                </td>
              <td>
                {{ $product->quantities }} pcs
              </td>
              <td>
                ${{ $product->product_price }}
                </td>
                @if (App\Review::where('billing_id',$product->id)->exists())
                  <td>----</td>
                @else
                <td><a class="btn btn-sm btn-info" href="{{ url('customer/product/reviews') }}/{{$product->id}}">Reviews</a>
                </td>
                @endif
            </tr>
          @endforeach
            </tbody>
          </table>
        </div>
      </div>
        </section>
      </div>
      </div>
    </div>
@endsection
