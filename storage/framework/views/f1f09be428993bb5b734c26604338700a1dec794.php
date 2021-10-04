
<?php $__env->startSection('content'); ?>
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
                        <form method="post" action="<?php echo e(route('product.update',$products->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" id="inputEmail3" required value="<?php echo e($products->name); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input type="number" name="quantity" class="form-control" id="inputEmail3" required value="<?php echo e($products->quantity); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description" aria-label="With textarea" required><?php echo e($products->description); ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="inputEmail">Select Category</label>
                                <div class="col-8">
                                    <select class="form-select col-12" name="category_name" aria-label="Default select example">
                                        <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($category->category_name == $products->category_name): ?><?php echo e("selected"); ?> <?php endif; ?> value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="inputEmail">Select sub Category</label>
                                <div class="col-8">
                                    <select class="form-select col-12" name="subcategory_name" aria-label="Default select example">
                                        <?php $__currentLoopData = $subcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($category->subcategory_name == $products->subcategory_name): ?><?php echo e("selected"); ?> <?php endif; ?> value="<?php echo e($category->subcategory_name); ?>"><?php echo e($category->subcategory_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Uploaded Images</label>
                                <div class="col-sm-12">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-8">Image</th>
                                            <th class="col-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $values = str_replace (array('"'), '' , $img->file);?>
                                            <tr>
                                                <td><img src="<?php echo e(asset('storage/images')); ?>/<?php echo e($values); ?>" width="440px" height="200px" alt="Image"></td>
                                                <td>
                                                <button type="button" class="btn btn-danger btn-sm btn-icon-split deletebtn" value="<?php echo e($values); ?>" >
                                                    <span class="icon text-white-50">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="text">Delete</span>
                                                </button> 
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-10 col-form-label">Uploaded Video</label>
                                <button type="button" class="btn mb-3 bg-gradient-success border-0 btn-sm btn-icon-split addvideo" value="<?php echo e($products->id); ?>" >
                                    <span class="icon text-white-50">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </span>
                                    <span class="text text-white">Add</span>
                                </button>
                                <div class="col-sm-12">
                                <?php if($products->video): ?>
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="col-8">Video</th>
                                                <th class="col-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><iframe height="400"  width="440" src="<?php echo e(asset('storage/video')); ?>/<?php echo e($products->video); ?>"></iframe></td>
                                                <td>
                                                <button type="button" class="btn btn-danger btn-sm btn-icon-split deletevideo" value="<?php echo e($products->id); ?>" >
                                                    <span class="icon text-white-50">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="text">Delete</span>
                                                </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <button type="submit" class="d-grid btn bg-gradient-success text-white border-0 btn-block m-auto w-50">Update</button>
                            </div>
                        </form>
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
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
                        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" id="video_id" name="video_id">
                                            <div class="text-center">
                                                <i class="fa fa-exclamation-circle fa-5x" style="color:#f8bb86;" aria-hidden="true"></i>
                                            </div>
                                            <h3 class="modal-title text-center" id="exampleModalLabel">Are you sure?</h3>
                                            <p class="text-center">Once deleted, you will not be able to recover this!</p>
                                            <div class="text-right">
                                                <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" title="delete" style="background-color: #e64942;color:#fff" data-bs-dismiss="modal" class="btn video">OK</button>  
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addvideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" id="addvideo_id" name="addvideo_id">
                                            <h5 class="text-center text-dark">Upload Video</h5>
                                            <div class="row mb-3 mr-5 ml-5">
                                                <div class="col-12 input-group">
                                                    <input type="file" name="video" id="addvideo" class="form-control " id="exampleInputEmail"> 
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" title="delete" style="background-color: #e64942;color:#fff" data-bs-dismiss="modal" class="btn add-video bg-gradient-success border-0">Upload</button>  
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function(){
    // $('.deletebtn').click(function (e) {
    //     e.preventDefault();
    //     // alert('hello');
    //     var id = $(this).val();
    //     // alert(id);
    //     $('#deleteModal').modal('show');
    //     $('#delete_id').val(id);

    //     var data = $('.delete_id').val();

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type:"DELETE",
    //         url:"/img-delete/",
    //         data:data,
    //         dataType: "json",
    //         success: function(response) {
    //             console.log(response);   
    //         },
    //     });
    // });
    $('.deletevideo').click(function (e) {
        e.preventDefault();
        // alert('hello');
        var id = $(this).val();
        // alert(id);
        $('#videoModal').modal('show');
        $('#video_id').val(id);
    });
    $('.video').click(function (e) {
        e.preventDefault();
        // alert('hello');
        var data = {
            'id': $('#video_id').val(),
        }

        // alert(data);
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
    // $('.addvideo').click(function (e) {
    //     e.preventDefault();
    //     // alert('hello');
    //     var id = $(this).val();
    //     // alert(id);
    //     $('#addvideoModal').modal('show');
    //     $('#addvideo_id').val(id);
    // });
    // $('.add-video').click(function (e) {
    //     e.preventDefault();
    //     // alert('hello');
    //     var data = {
    //         'id': $('#addvideo_id').val(),
    //         'video': $('#addvideo').val(),
    //     }

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type:"POST",
    //         url:"/video-add",
    //         data:data,
    //         dataType: "json",
    //         success: function(response) {
    //             console.log(response);
             
    //         },
    //     });
    // });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Desktop\projects\laravel_ecomm\resources\views/products/edit_product.blade.php ENDPATH**/ ?>