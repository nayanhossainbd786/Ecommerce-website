@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6 mt-3">
        <div class="card">
          <div class="card-header bg-info">
            Category List
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">S I No </th>
                  <th scope="col">Category Name</th>
                  <th scope="col">Created At </th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($categories as $category)
                  <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$category->category_name}}</td>
                    {{-- <td>{{$category->created_at->format('d:m:Y')}}</td> --}}
                    <td>{{$category->created_at->diffforHumans()}}</td>
                    <td>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            
                            <a href="{{ url('category/delete') }}/{{$category->id}}"type="button" class="btn btn-danger btn-sm">Delete</a>
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

          </div>
        </div>
      </div>
      <div class="col-6 mt-3">
        <div class="card">
          <div class="card-header bg-info">
            Add New Category
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

              <form action="{{ url('category/add/insert') }}" method="post">
                @csrf
              <div class="form-group">
                <label >Category Name</label>
                <input type="text"name="category_name" class="form-control" placeholder="Enter Category Name" >
              </div>

              <button type="submit" class="btn btn-success">Add Category</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
