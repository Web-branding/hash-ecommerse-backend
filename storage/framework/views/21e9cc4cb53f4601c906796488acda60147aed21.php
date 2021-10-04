
<?php $__env->startSection('content'); ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Details</h3></div>
                <form class="row m-3 g-3" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="col-12">
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Order ID</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($order->order_id); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($order->fname); ?> <?php echo e($order->lname); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($order->email); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($order->phone); ?>">
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
                                <?php $__currentLoopData = $orderitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($items->product); ?></td>
                                        <td><?php echo e($items->quantity); ?></td>
                                        <td><?php echo e($items->price); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Shipping Address</label>
                            <div class="col-sm-9">
<?php $__currentLoopData = $shipping; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo e($ship->address); ?>

<?php echo e($ship->city); ?>

<?php echo e($ship->state); ?>

<?php echo e($ship->country); ?>

<?php echo e($ship->zip); ?>

</textarea>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($order->status); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Ordered Date</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($order->created_at); ?>">
                            </div>
                        </div>
                        <?php if($order->status == 'Delivered'): ?>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Delivered Date</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($order->updated_at); ?>">
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($order->status == 'Cancelled'): ?>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Cancelled Date</label>
                            <div class="col-sm-9">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($order->updated_at); ?>">
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row mb-3 justify-content-end">
                            <label for="inputState" class="col-sm-6 form-label">Status</label>
                            <div class="col-md-3">
                                <input type="submit" formaction="<?php echo e(route('status', $order->id)); ?>"
                                name="delivered" value="Delivered" class="btn bg-gradient-success text-white border-0 btn-block">
                            </div>
                            <div class="col-md-3">
                                <input type="submit" formaction="<?php echo e(route('status', $order->id)); ?>"
                                name="canceled" value="Cancelled" class="btn bg-gradient-success text-white border-0 btn-block">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Desktop\projects\ecomm_backend\resources\views/order/detail.blade.php ENDPATH**/ ?>