@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Product</h1> 
    </div>
</div>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update</h3></div>
                    <div class="card-body">
                        <form method="post" action="{{route('product.update',$products->id)}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="pd" class="form-control" id="inputEmail3" required value="{{$products->pd_id}}">
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" id="inputEmail3" required value="{{$products->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input type="number" name="quantity" class="form-control" id="inputEmail3" required value="{{$products->quantity}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input type="number" name="price" class="form-control" id="inputEmail3" required value="{{$products->price}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Stock Status</label>
                                <div class="col-sm-8">
                                    <select class="form-select col-12" name="stock_status" aria-label="Default select example">
                                        <option selected>---Select---</option>
                                        <option @if($products->stock_status == 'Instock'){{"selected"}} @endif value="Instock">In stock</option>
                                        <option @if($products->stock_status == 'Outofstock'){{"selected"}} @endif value="Outofstock">Out of stock</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description" aria-label="With textarea" required>{{$products->description}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="inputEmail">Select Category</label>
                                <div class="col-8">
                                    <select class="form-select col-12" name="category_name" aria-label="Default select example">
                                        @foreach($cat as $category)
                                            <option @if($category->category_name == $products->category_name){{"selected"}} @endif value="{{$category->category_name}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="inputEmail">Select sub Category</label>
                                <div class="col-8">
                                    <select class="form-select col-12" name="subcategory_name" aria-label="Default select example">
                                        @if($products->subcategory_name == "")
                                            <option selected>---Select---</option>
                                            @foreach($subcat as $category)
                                                <option value="{{$category->subcategory_name}}">{{$category->subcategory_name}}</option>
                                            @endforeach
                                        @else
                                            @foreach($subcat as $category)
                                                <option @if($category->subcategory_name == $products->subcategory_name){{"selected"}} @endif value="{{$category->subcategory_name}}">{{$category->subcategory_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                            <label class="col-sm-9 col-form-label" for="inputEmail">Uploaded Images</label>
                            <button type="button" class="mb-3 btn bg-gradient-success border-0 text-white btn-icon-split addimg" value="{{$products->name}}" >
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Add Image</span>
                            </button> 
                            @if($imgproducts)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-9">Image</th>
                                            <th class="col-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($imgproducts as $product)
                                            @php
                                                $values = str_replace (array('"'), '' , $product->file);
                                            @endphp
                                            <tr>
                                                <td><img src="{{asset('images/products')}}/{{$values}}" width="200px" height="200px" alt="Image"></td>
                                                <td>
                                                <button type="button" class="btn btn-danger btn-sm btn-icon-split deleteimg" value="{{$product->file}}" >
                                                    <span class="icon text-white-50">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="text">Delete</span>
                                                </button> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            </div>
                            <div class="row mb-3">
                            <label class="col-sm-9 col-form-label" for="inputEmail">Uploaded Video</label>
                            <button type="button" class="mb-3 btn bg-gradient-success border-0 text-white btn-icon-split addvideo" value="{{$products->name}}" >
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                                <span class="text">Add Video</span>
                            </button> 
                            @if($products->video)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-9">Video</th>
                                            <th class="col-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><iframe height="400"  width="400" src="{{asset('videos/products')}}/{{$products->video}}"></iframe></td>
                                            <td>
                                            <button type="button" class="btn btn-danger btn-sm btn-icon-split deletevideo" value="{{$products->video}}" >
                                                <span class="icon text-white-50">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </span>
                                                <span class="text">Delete</span>
                                            </button> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            </div>
                            <div class="mt-4 mb-0">
                                <button type="submit" class="d-grid btn bg-gradient-success text-white border-0 btn-block m-auto w-50">Update</button>
                            </div>
                        </form>
                        <!-- delete image modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            @csrf
                                            <input type="hidden" id="delete_id" name="delete_id">
                                            <div class="text-center">
                                                <i class="fa fa-exclamation-circle fa-5x" style="color:#f8bb86;" aria-hidden="true"></i>
                                            </div>
                                            <h3 class="modal-title text-center" id="exampleModalLabel">Are you sure?</h3>
                                            <p class="text-center">Once deleted, you will not be able to recover this!</p>
                                            <div class="text-right">
                                                <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" title="delete" style="background-color: #e64942;color:#fff" data-bs-dismiss="modal" class="btn imgdelete">Delete</button>  
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- add image modal -->
                        <div class="modal fade" id="addimgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form method="post" id="upload_image" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="addimg_id" name="pd_id">
                                            <h3 class="modal-title text-center" id="exampleModalLabel">Upload Image</h3>
                                            <input type="file" name="file[]" class="mb-3 form-control " id="exampleInputEmail"> 
                                            <div class="text-right">
                                                <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" title="delete" style="background-color: #e64942;color:#fff" data-bs-dismiss="modal" class="btn bg-gradient-success border-0 imgadd">Upload</button>  
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- delete video modal -->
                        <div class="modal fade" id="deletevideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            @csrf
                                            <input type="hidden" id="deletevideo_id" name="deletevideo_id">
                                            <div class="text-center">
                                                <i class="fa fa-exclamation-circle fa-5x" style="color:#f8bb86;" aria-hidden="true"></i>
                                            </div>
                                            <h3 class="modal-title text-center" id="exampleModalLabel">Are you sure?</h3>
                                            <p class="text-center">Once deleted, you will not be able to recover this!</p>
                                            <div class="text-right">
                                                <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" title="delete" style="background-color: #e64942;color:#fff" data-bs-dismiss="modal" class="btn videodelete">Delete</button>  
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- add video modal -->
                        <div class="modal fade" id="addvideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form method="post" id="upload_video" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="addvideo_id" name="addvideo_id">
                                            <h3 class="modal-title text-center" id="exampleModalLabel">Upload Video</h3>
                                            <input type="file" name="video" class="mb-3 form-control " id="exampleInputEmail"> 
                                            <div class="text-right">
                                                <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" title="delete" style="background-color: #e64942;color:#fff" data-bs-dismiss="modal" class="btn bg-gradient-success border-0 videoadd">Upload</button>  
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    // delete image
    $('.deleteimg').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        $('#deleteModal').modal('show');
        $('#delete_id').val(id);
    });
    $(document).on('click', '.imgdelete', function(e) {
        e.preventDefault();
        var data = {
            'file': $('#delete_id').val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"DELETE",
            url:"/image-delete",
            data:data,
            dataType: "json",
            success: function(response) {
                console.log(response);
                window.location.reload();
            },
        });
    });
    // add image
    $('.addimg').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        $('#addimgModal').modal('show');
        $('#addimg_id').val(id);
    });
    $('#upload_image').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"POST",
            url:"/image-upload",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response);
                window.location.reload();
            },
        });
    });
    // delete video
    $('.deletevideo').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        $('#deletevideoModal').modal('show');
        $('#deletevideo_id').val(id);
    });
    $(document).on('click', '.videodelete', function(e) {
        e.preventDefault();
        var data = {
            'video': $('#deletevideo_id').val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"DELETE",
            url:"/video-delete",
            data:data,
            dataType: "json",
            success: function(response) {
                console.log(response);
                window.location.reload();
            },
        });
    });
    // add video
    $('.addvideo').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        $('#addvideoModal').modal('show');
        $('#addvideo_id').val(id);
    });
    $('#upload_video').on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"POST",
            url:"/video-upload",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response);
                window.location.reload();
            },
        });
    });
});
</script>
@endsection