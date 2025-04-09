

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?php echo app('translator')->get('messages.add_task'); ?></h5>
                </div>
                <?php if(!Auth::guest()): ?>
                    <div class="card-body">
                        <form method="post" action="addWork">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="profesor" value="<?php echo e(Auth::user()->name); ?>">

                            <div class="mb-3">
                                <label for="naziv_rada" class="form-label"><?php echo app('translator')->get('messages.name'); ?></label>
                                <input type="text" class="form-control" name="naziv_rada" required>
                            </div>

                            <div class="mb-3">
                                <label for="naziv_rada_eng" class="form-label"><?php echo app('translator')->get('messages.name_english'); ?></label>
                                <input type="text" class="form-control" name="naziv_rada_eng" required>
                            </div>

                            <div class="mb-3">
                                <label for="zadatak_rada" class="form-label"><?php echo app('translator')->get('messages.description'); ?></label>
                                <input type="text" class="form-control" name="zadatak_rada" required>
                            </div>

                            <div class="mb-3">
                                <label for="tip_stud" class="form-label"><?php echo app('translator')->get('messages.study_type'); ?></label>
                                <select required class="form-select" name="tip_stud">
                                    <option value="Diplomski"><?php echo app('translator')->get('messages.graduate'); ?></option>
                                    <option value="Preddiplomski"><?php echo app('translator')->get('messages.undergraduate'); ?></option>
                                    <option value="Strucni"><?php echo app('translator')->get('messages.prof_stud_prog'); ?></option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100"><?php echo app('translator')->get('messages.add_task'); ?></button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\madel\NWPlv5\resources\views/add_task.blade.php ENDPATH**/ ?>