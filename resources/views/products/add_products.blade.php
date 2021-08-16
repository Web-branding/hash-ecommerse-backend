@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Products</h1> 
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
                <div class="card shadow-lg border-0 rounded-lg m-3">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">New Product</h3></div>
                    <div class="card-body">
                        <form method="post" action="{{route('add-products')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" id="inputEmail3" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input type="number" name="quantity" class="form-control" id="inputEmail3" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Stock Status</label>
                                <div class="col-sm-8">
                                    <select class="form-select col-12" name="stock_status" aria-label="Default select example">
                                        <option selected>---Select---</option>
                                        <option value="Instock">In stock</option>
                                        <option value="Outofstock">Out of stock</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description" aria-label="With textarea" required></textarea>
                                </div>
                            </div>
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
                                <label class="col-sm-4 col-form-label" for="inputEmail">Select sub Category</label>
                                <div class="col-8">
                                    <select class="form-select col-12" name="subcategory_name" aria-label="Default select example">
                                        <option selected>---Select---</option>
                                        @foreach($subcategory as $subcat)
                                            <option value="{{$subcat->subcategory_name}}">{{$subcat->subcategory_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 increment">
                                <label for="formGroupExampleInput" class="col-sm-4 col-form-label">Upload Images</label>
                                <div class="col-8 input-group">
                                    <input type="file" name="file[]" class="myfrm form-control " id="exampleInputEmail"> 
                                    <button class="btn bg-gradient-success text-white border-0 add-file" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="row clone d-none">
                                <div class="col-8 offset-4 remove control-group lst input-group" style="margin-top:10px;margin-bottom:10px">
                                    <input type="file" name="file[]" class="myfrm form-control">
                                    <div class="input-group-btn"> 
                                    <button class="btn btn-danger" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="formGroupExampleInput" class="col-sm-4 col-form-label">Upload Video</label>
                                <div class="col-8 input-group">
                                    <input type="file" name="video" class="form-control " id="exampleInputEmail"> 
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
@section('scripts')
<script>
$(document).ready(function(){
    $('.add-file').click(function (e) {
        e.preventDefault();
        // alert('hello');
        var data = $(".clone").html();
        $(".increment").after(data);
        $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".remove").remove();
      });
    });
});
</script>
@endsection