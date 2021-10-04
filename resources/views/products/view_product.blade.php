@extends('layouts.admin_layout')
@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Details</h3></div>
                <form class="row m-3 g-3">
                    <div class="col-12">
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$product->name}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$product->quantity}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$product->price}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea disabled class="form-control" name="address" aria-label="With textarea">{{$product->description}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$product->category_name}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sub Category</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$product->subcategory_name}}">
                            </div>
                        </div>
                    </div>
                    @if($imgproduct)
                    <div class="col-12">
                        <p>Images</p>
                        <div class="row">
                            @foreach($imgproduct as $image)
                                @php 
                                    $files = $image->file;
                                    $values = str_replace (array('"'), '' , $files);
                                @endphp
                                <div class="col-lg-6 mb-4">
                                    <div class="card text-white shadow">
                                        <div class="card-body">
                                            <img src="{{asset('images/products')}}/{{$values}}" width="200px" height="200px" alt="Image">
                                            <div class="text-dark">{{$values}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($product->video)
                    <div class="col-12">
                        <p>Video</p>
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <iframe height="400"  width="400" src="{{asset('videos/products')}}/{{$product->video}}"></iframe>
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</main>
@endsection