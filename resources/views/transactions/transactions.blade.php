@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Payment Mode</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction as $trans)
                        <tr>
                            <td class="text-center">{{$trans->order_id}}</td>
                            <td class="text-center">{{$trans->payment_mode}}</td>
                            <td class="text-center">{{$trans->status}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $transaction->links() !!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
