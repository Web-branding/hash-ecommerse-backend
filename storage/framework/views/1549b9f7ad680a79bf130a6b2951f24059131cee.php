
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Category</h1> 
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
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">New Category</h3></div>
                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('add-category')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-floating mb-3">
                                <label for="inputEmail">Category Name</label>
                                <input class="form-control" id="inputEmail" name="category_name" type="text" placeholder="Category Name" />
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
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Desktop\projects\laravel_ecomm\resources\views/category/add_category.blade.php ENDPATH**/ ?>