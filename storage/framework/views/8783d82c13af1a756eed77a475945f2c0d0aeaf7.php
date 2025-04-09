

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Select role</div>
                <?php if(!Auth::guest()): ?>
                    <div class="panel-body">
                        <form method="post" action="home">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <select required class="selectpicker" name="role">
                                <option value="Admin">Admin</option>
                                <option value="Profesor">Profesor</option>
                                <option value="Student">Student</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-info">Proceed</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\madel\NWPlv5\resources\views/role_selection.blade.php ENDPATH**/ ?>