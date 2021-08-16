@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Sub Category</h1> 
    </div>
</div>
<div class="container">
    @if(Session::has('add'))
        <div class="alert alert-success" role="alert">
            {{Session::get('add')}}
        </div>
    @endif
</div>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">New Sub Category</h3></div>
                    <div class="card-body">
                        <form method="post" action="{{route('add-subcategory')}}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="inputEmail">Select Category</label>
                                <div class="col-8">
                                    <select class="form-select col-12" name="category_name" aria-label="Default select example">
                                        <option selected>---Select---</option>
                                        @foreach($category as $cat)
                                            <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Sub Category Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="subcategory_name" class="form-control" id="inputEmail3" placeholder="Sub Category Name">
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <button type="submit" class="d-grid btn bg-gradient-success text-white border-0 btn-block m-auto w-50">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection