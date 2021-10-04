
<?php $__env->startSection('content'); ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Details</h3></div>
                <form class="row m-3 g-3">
                    <div class="col-12">
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($product->name); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($product->quantity); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea disabled class="form-control" name="address" aria-label="With textarea"><?php echo e($product->description); ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($product->category_name); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Sub Category</label>
                            <div class="col-sm-10">
                                <input disabled type="text" name="place" class="form-control" id="inputPassword3" value="<?php echo e($product->subcategory_name); ?>">
                            </div>
                        </div>
                    </div>
                    <?php if($imgproduct): ?>
                    <div class="col-12">
                        <p>Images</p>
                        <div class="row">
                            <?php $__currentLoopData = $imgproduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $files = $image->file;
                                    $values = str_replace (array('"'), '' , $files);
                                ?>
                                <div class="col-lg-6 mb-4">
                                    <div class="card text-white shadow">
                                        <div class="card-body">
                                            <img src="<?php echo e(asset('storage/images')); ?>/<?php echo e($values); ?>" width="200px" height="200px" alt="Image">
                                            <div class="text-dark"><?php echo e($values); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($product->video): ?>
                    <div class="col-12">
                        <p>Video</p>
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <iframe height="400"  width="400" src="<?php echo e(asset('storage/videos')); ?>/<?php echo e($product->video); ?>"></iframe>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Downloads\ecomm_backend\resources\views/products/view_product.blade.php ENDPATH**/ ?>