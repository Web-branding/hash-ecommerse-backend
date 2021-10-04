@extends('layouts.admin_layout')
@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Details</h3></div>
                <form class="row m-3 g-3" method="POST">
                    @csrf
                    <div class="col-12">
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Order ID</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$order->order_id}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$order->fname}} {{$order->lname}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$order->email}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$order->phone}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Product Details</label>
                        </div>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderitems as $items)
                                    <tr>
                                        <td>{{$items->product}}</td>
                                        <td>{{$items->quantity}}</td>
                                        <td>{{$items->price}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Shipping Address</label>
                            <div class="col-sm-9">
@foreach($shipping as $ship)
<textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="5">{{$ship->address}}
{{$ship->city}}
{{$ship->state}}
{{$ship->country}}
{{$ship->zip}}
</textarea>
@endforeach
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$order->status}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Ordered Date</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$order->created_at}}">
                            </div>
                        </div>
                        @if($order->status == 'Delivered')
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Delivered Date</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$order->updated_at}}">
                            </div>
                        </div>
                        @endif
                        @if($order->status == 'Cancelled')
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Cancelled Date</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="{{$order->updated_at}}">
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3 justify-content-end">
                            <label for="inputState" class="col-sm-6 form-label">Status</label>
                            <div class="col-md-3">
                                <input type="submit" formaction="{{route('status', $order->id)}}"
                                name="delivered" value="Delivered" class="btn bg-gradient-success text-white border-0 btn-block">
                            </div>
                            <div class="col-md-3">
                                <input type="submit" formaction="{{route('status', $order->id)}}"
                                name="canceled" value="Cancelled" class="btn bg-gradient-success text-white border-0 btn-block">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection