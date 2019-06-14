@extends('layouts.app')
@section('content')
        <div class="container">
                  <div class="row">
                    <div class="col-8 mt-3">
                      <div class="card">
                        <div class="card-header bg-info">
                          Category List
                        </div>
                        <div class="card-body">
                          <table class="table table-bordered">
                            <thead>
                              <tr>

                                <th scope="col">Coupon Name</th>
                                <th scope="col">Discount At </th>
                                <th scope="col">Valid Till</th>
                                <th scope="col">Valid Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($coupons as $coupon)
                                <tr>
                                  <td>{{ $coupon->coupon_name }}</td>
                                  <td>{{ $coupon->discount_amount }}</td>
                                  <td>{{ $coupon->valid_till }}</td>
                                  <td>{{Carbon\Carbon::now()->format('Y-m-d') }}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                          {{ $coupons->links() }}
                        </div>
                      </div>
                    </div>
                    <div class="col-4 mt-3">
                      <div class="card">
                        <div class="card-header bg-info">
                          Add  Coupon
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

                          <form action="{{ url('coupon/add/insert') }}" method="post" enctype="multipart/form-data">
                              @csrf

                            <div class="form-group">
                                <label >Coupon Name</label>
                                <input type="text"name="coupon_name" class="form-control" placeholder="Enter Coupon Name" >
                            </div>
                            <div class="form-group">
                                <label >Discount Amount(%)</label>
                                <input type="text"name="discount_amount" class="form-control" placeholder="Enter Discount Amount" >
                            </div>
                            <div class="form-group">
                                <label >Valid Till(Date) </label>
                                <input type="date"name="valid_till" class="form-control" placeholder="Enter Valid Till Date" >
                            </div>

                            <button type="submit" class="btn btn-success">Add Product</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

@endsection
