@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid">
<div class="container">
    @if(Session::has('update'))
        <div class="alert alert-success" role="alert">
            {{Session::get('update')}}
        </div>
    @endif
    @if(Session::has('delete'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('delete')}}
        </div>
    @endif
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-9">Category Name</th>
                        <th class="col-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category as $cat)
                        <tr>
                            <td>{{$cat->category_name}}</td>
                            <td>
                            <a href="{{route('category.edit',$cat->id)}}" class="btn btn-success btn-sm btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-split deletebtn" value="{{$cat->id}}" >
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
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{ route('category.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" id="delete_id" name="delete_id">
                                <div class="text-center">
                                    <i class="fa fa-exclamation-circle fa-5x" style="color:#f8bb86;" aria-hidden="true"></i>
                                </div>
                                <h3 class="modal-title text-center" id="exampleModalLabel">Are you sure?</h3>
                                <p class="text-center">Once deleted, you will not be able to recover this!</p>
                                <div class="text-right">
                                    <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" title="delete" style="background-color: #e64942;color:#fff" class="btn">OK</button>  
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
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        // alert('hello');
        var id = $(this).val();
        // alert(id);
        $('#deleteModal').modal('show');
        $('#delete_id').val(id);
    });
});
</script>
@endsection