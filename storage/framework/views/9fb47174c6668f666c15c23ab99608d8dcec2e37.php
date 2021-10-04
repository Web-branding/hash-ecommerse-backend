
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New People</h1> 
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
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add</h3></div>
                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('add-people')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Box Number</label>
                                <div class="col-sm-9">
                                    <input type="number" name="box" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Place</label>
                                <div class="col-sm-9">
                                    <input type="text" name="place" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="number" name="phone" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Email id</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" name="amount" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <button type="submit" class="d-grid btn btn-primary btn-block m-auto w-50">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Desktop\projects\laravel_ecomm\resources\views/add_people.blade.php ENDPATH**/ ?>