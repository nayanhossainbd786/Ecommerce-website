@extends('layouts.app')
@section('customer')


@if (App\Sale::where('user_id',Auth::id())->exists())

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
        <section class="">
          <div class="card">
    <div class="card-header text-center">
      Total
      <span>{{ $total_sales }}  {{ ($total_sales <=1)? 'Order':'Orders' }} </span>
    </div>
      <div class="card-header text-center">
        {{ ($total_sales <=1)? 'Order':'Orders' }} List
      </div>

      <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">S I No</th>
              <th scope="col">Total Amount</th>
              <th scope="col">Payment Type</th>
              <th scope="col">Payment Status</th>
              <th scope="col">Purchase at</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($total_orders as $total_order)
              <tr class="{{ ($total_order->relationtoShipping->payment_status ==1)? 'bg-secondary': 'Paid'}}">
                <td>{{$loop->index+1}}</td>
                <td>${{ $total_order->total}}</td>
                <td>{{ ($total_order->relationtoShipping->payment_type ==1)? 'Cash On Delivery': 'Credit card'}}</td>
                <td>{{ ($total_order->relationtoShipping->payment_status ==1)? 'Not Yet': 'Paid'}}</td>
                <td>{{ $total_order->created_at->diffForhumans()}}</td>
                <td>
                  <a class="btn btn-sm btn-info" href="{{ url('customer/product/info') }}/{{$total_order->id}}">View Details</a>
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
    </div>
        </section>
      </div>
      </div>
    </div>




@endif

@endsection
