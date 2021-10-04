
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Sub Category</h1> 
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
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">New Sub Category</h3></div>
                    <div class="card-body">
                        <form class="user" method="POST" action="<?php echo e(route('slide.add')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput" class="form-label">Title</label>
                                <input name="title" type="text" class="form-control " id="exampleInputEmail"
                                    placeholder="Title...">
                            </div>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput" class="form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Description..." id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput" class="form-label">Upload Slide</label>
                                <input name="file" type="file" class="form-control " id="exampleInputEmail">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <button type="submit" class="d-grid btn bg-gradient-success text-white border-0 btn-block m-auto w-50">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Desktop\projects\ecomm_backend\resources\views/slides/add_slide.blade.php ENDPATH**/ ?>