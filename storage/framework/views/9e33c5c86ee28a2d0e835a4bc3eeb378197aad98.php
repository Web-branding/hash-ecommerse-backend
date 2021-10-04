
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
<div class="container">
    <?php if(Session::has('update')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('update')); ?>

        </div>
    <?php endif; ?>
    <?php if(Session::has('delete')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo e(Session::get('delete')); ?>

        </div>
    <?php endif; ?>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sub Category List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($cat->category_name); ?></td>
                            <td><?php echo e($cat->subcategory_name); ?></td>
                            <td>
                            <a href="<?php echo e(route('subcategory.edit',$cat->id)); ?>" class="btn btn-success btn-sm btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-split deletebtn" value="<?php echo e($cat->id); ?>" >
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
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="<?php echo e(route('subcategory.destroy')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Desktop\projects\laravel_ecomm\resources\views/subcategory/sub_category.blade.php ENDPATH**/ ?>