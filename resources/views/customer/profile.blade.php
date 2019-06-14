@extends('layouts.app')
@section('customer')

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
          @if (App\Profile::where('user_id',Auth::id())->exists())
            @php
              $singledata=App\Profile::where('user_id',Auth::id())->first();
            @endphp
            <div class="card">
              <div class="card-header">
                <h4 class="checkout-title text-center">Update Your Information </h4>
              </div>
              <div class="card-body">
                <form action="{{ url('customer/info/update') }}" method="post" class="checkout-form">
                    @csrf
                      <div class="form-group">
                        <label >First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name *"value="{{ $singledata->first_name }}">
                      </div>
                      <div class="form-group">
                        <label >Last Name</label>
                        <input type="text" name="last_name"  class="form-control" placeholder="Last Name *"value="{{ $singledata->last_name }}">
                      </div>
                      <div class="form-group">
                        <label >Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Address *"value="{{ $singledata->address }}">

                      </div>
                      <div class="form-group">
                        <label >Phone Number</label>
                        <input type="text"name="phone_number" class="form-control"  placeholder="Phone Number *"value="{{ $singledata->phone_number }}">
                      </div>
                      <div class="form-group">
                        <label >Zip Code Number</label>
                        <input type="text"name="zip_code" class="form-control"  placeholder="Zip Code"value="{{ $singledata->zip_code }}">
                      </div>

                      <button type="submit" class="btn btn-info">Update Info</button>
                    </div>
                  </div>
                  </form>
              </div>
            </div>
          @else
              <div class="card">
                <div class="card-header">
                  <h4 class="text-center">Add Your Information </h4>
                </div>
                <div class="card-body">
                  <form action="{{ url('customer/info/insert')  }}" method="post" class="checkout-form">
                    @csrf

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
                    <div class="form-group">
                      <label >First Name</label>
                      <input type="text" name="first_name"  class="form-control" placeholder="First Name *">
                    </div>
                    <div class="form-group">
                      <label >Last Name</label>
                      <input type="text" name="last_name" class="form-control" placeholder="Last Name *">
                    </div>
                    <div class="form-group">
                      <label >Address</label>
                      <input type="text" name="address"class="form-control" placeholder="Address *">
                    </div>
                    <div class="form-group">
                      <label >Phone Number</label>
                      <input type="text"name="phone_number" class="form-control"  placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                      <label >Zip Code Number</label>
                      <input type="text"name="zip_code" class="form-control"  placeholder="Zip Code">
                    </div>
                    <button type="submit" class="btn btn-info">Add Info</button>
                  </div>
                </div>
                  </form>
                </div>
              </div>

        </section>
      </div>
      </div>
    </div>

      @endif

@endsection
