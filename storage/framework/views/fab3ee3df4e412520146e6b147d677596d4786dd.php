

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📋 <?php echo app('translator')->get('messages.details'); ?></h5>
                </div>

                <div class="card-body">
                    <?php $__currentLoopData = $tasksData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <form method="post" action="accept/confirm" class="mb-4">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">

                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.name'); ?></th>
                                        <th><?php echo app('translator')->get('messages.description'); ?></th>
                                        <th><?php echo app('translator')->get('messages.study_type'); ?></th>
                                        <th><?php echo app('translator')->get('messages.student'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e($task->name); ?></td>
                                        <td><?php echo e($task->task_goal); ?></td>
                                        <td><?php echo e($task->study_type); ?></td>
                                        <td>
                                            <select name="student" class="form-select" required>
                                                <option disabled selected>-- Odaberi studenta --</option>
                                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($student); ?>"><?php echo e($student); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success"><?php echo app('translator')->get('messages.confirm_student'); ?></button>
                            </div>
                        </form>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\madel\NWPlv5\resources\views/task_details.blade.php ENDPATH**/ ?>