
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Products</h1> 
    </div>
</div>
<div class="container">
    <?php if(Session::has('add')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('add')); ?>

        </div>
    <?php endif; ?>
</div>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg m-3">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">New Product</h3></div>
                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('add-products')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
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
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat->category_name); ?>"><?php echo e($cat->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label" for="inputEmail">Select sub Category</label>
                                <div class="col-8">
                                    <select class="form-select col-12" name="subcategory_name" aria-label="Default select example">
                                        <option selected>---Select---</option>
                                        <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subcat->subcategory_name); ?>"><?php echo e($subcat->subcategory_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Downloads\ecomm_backend\resources\views/products/add_products.blade.php ENDPATH**/ ?>