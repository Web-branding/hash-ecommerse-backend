
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-10">
        <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
        </div>
        <div class="col">
        <a href="<?php echo e(route('download-orders')); ?>" class="btn bg-gradient-success text-white border-0 btn-sm btn-icon-split">
            <span class="icon text-white-50">
                <i class="fa fa-download" aria-hidden="true"></i>
            </span>
            <span class="text">Download</span>
        </a>
        </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $or): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($or->fname); ?> <?php echo e($or->lname); ?></td>
                            <td class="text-center"><?php echo e($or->status); ?></td>
                            <td class="text-center">
                            <a href="<?php echo e(route('details', $or->id)); ?>" class="btn bg-gradient-success text-white border-0 btn-sm btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </span>
                                <span class="text">Details</span>
                            </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <?php echo $order->links(); ?>

            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Desktop\projects\ecomm_backend\resources\views/order/order.blade.php ENDPATH**/ ?>