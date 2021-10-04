
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(Session::has('delete')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo e(Session::get('delete')); ?>

        </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Slide List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color:#f8f9fc">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th style="width:25px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($slide->title); ?></td>
                                <td><?php echo e($slide->description); ?></td>
                                <td><img src="<?php echo e(asset('storage/slides')); ?>/<?php echo e($slide->file); ?>" width="80px" height="80px" alt="Image"></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm btn-icon-split deletebtn" value="<?php echo e($slide->id); ?>" >
                                        <span class="icon text-white-50">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </span>
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
                                <form action="<?php echo e(route('slide.destroy')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <input type="hidden" id="delete_id" name="delete_id">
                                    <div class="text-center">
                                        <i class="fa fa-exclamation-circle fa-5x" style="color:#f8bb86;" aria-hidden="true"></i>
                                    </div>
                                    <h3 class="modal-title text-center" id="exampleModalLabel">Are you sure?</h3>
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
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Anju\Desktop\projects\ecomm_backend\resources\views/slides/slide.blade.php ENDPATH**/ ?>