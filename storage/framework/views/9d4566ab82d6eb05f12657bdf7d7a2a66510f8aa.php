

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <?php if(!Auth::guest()): ?>
                    <?php $__currentLoopData = $dataUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->email == $user->email): ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo app('translator')->get('messages.welcome1'); ?> <?php echo e($user->name); ?> <?php echo app('translator')->get('messages.welcome2'); ?></h5>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <?php if(!Auth::guest()): ?>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    
                    <?php if(Auth::user()->role == 'Admin'): ?>
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><?php echo e(Auth::user()->name); ?> <?php echo app('translator')->get('messages.admin_message'); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-3 mb-3">
                                <form method="post" action="croatian">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <input type="hidden" name="locale" value="hr">
                                    <button type="submit" class="btn btn-success">HR</button>
                                </form>
                                <form method="post" action="english">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <input type="hidden" name="locale" value="en">
                                    <button type="submit" class="btn btn-success">EN</button>
                                </form>
                            </div>

                            <hr>

                            
                            <?php $__currentLoopData = $dataUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($user->role != 'Admin'): ?>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-3">
                                            <strong><?php echo e($user->name); ?></strong>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="badge bg-info text-dark"><?php echo e($user->role); ?></span>
                                        </div>
                                        <div class="col-md-6">
                                            <form method="post" action="editUser" class="d-flex gap-2">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                                <select required class="form-select w-auto" name="role">
                                                    <option value="Profesor"><?php echo app('translator')->get('messages.profesor'); ?></option>
                                                    <option value="Student"><?php echo app('translator')->get('messages.student'); ?></option>
                                                </select>
                                                <button type="submit" class="btn btn-outline-primary"><?php echo app('translator')->get('messages.button'); ?></button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    
                    <?php elseif(Auth::user()->role == 'Profesor'): ?>
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><?php echo e(Auth::user()->name); ?> <?php echo app('translator')->get('messages.prof_message'); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-3 mb-3">
                                <form method="post" action="croatian">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <input type="hidden" name="locale" value="hr">
                                    <button type="submit" class="btn btn-success">HR</button>
                                </form>
                                <form method="post" action="english">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <input type="hidden" name="locale" value="en">
                                    <button type="submit" class="btn btn-success">EN</button>
                                </form>
                                <a href="<?php echo e(url('/addWork')); ?>" class="btn btn-outline-dark"><?php echo app('translator')->get('messages.add_task'); ?></a>
                            </div>

                            <table class="table table-hover mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.name'); ?></th>
                                        <th><?php echo app('translator')->get('messages.name_english'); ?></th>
                                        <th><?php echo app('translator')->get('messages.description'); ?></th>
                                        <th><?php echo app('translator')->get('messages.study_type'); ?></th>
                                        <th><?php echo app('translator')->get('messages.student'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $dataTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($task->profesor == Auth::user()->name): ?>
                                            <tr>
                                                <td><?php echo e($task->name); ?></td>
                                                <td><?php echo e($task->name_en); ?></td>
                                                <td><?php echo e($task->task_goal); ?></td>
                                                <td><?php echo e($task->study_type); ?></td>
                                                <td>
                                                    <?php if($task->choosen_student == null): ?>
                                                        <form method="get" action="accept">
                                                            <input type="hidden" name="taskId" value="<?php echo e($task->id); ?>">
                                                            <button type="submit" class="btn btn-sm btn-info"><?php echo app('translator')->get('messages.chooseStudent'); ?></button>
                                                        </form>
                                                    <?php else: ?>
                                                        <strong><?php echo app('translator')->get('messages.student'); ?>:</strong>
                                                        <span><?php echo e($task->choosen_student); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                    
                    <?php else: ?>
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><?php echo e(Auth::user()->name); ?> <?php echo app('translator')->get('messages.stud_message'); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-3 mb-3">
                                <form method="post" action="croatian">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <input type="hidden" name="locale" value="hr">
                                    <button type="submit" class="btn btn-success">HR</button>
                                </form>
                                <form method="post" action="english">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <input type="hidden" name="locale" value="en">
                                    <button type="submit" class="btn btn-success">EN</button>
                                </form>
                            </div>

                            <table class="table table-striped mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.name'); ?></th>
                                        <th><?php echo app('translator')->get('messages.name_english'); ?></th>
                                        <th><?php echo app('translator')->get('messages.description'); ?></th>
                                        <th><?php echo app('translator')->get('messages.study_type'); ?></th>
                                        <th><?php echo app('translator')->get('messages.profesor'); ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $dataTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($task->name); ?></td>
                                            <td><?php echo e($task->name_en); ?></td>
                                            <td><?php echo e($task->task_goal); ?></td>
                                            <td><?php echo e($task->study_type); ?></td>
                                            <td><?php echo e($task->profesor); ?></td>
                                            <td>
                                                <form method="post" action="registerWork">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="user" value="<?php echo e(Auth::user()->name); ?>">
                                                    <input type="hidden" name="taskId" value="<?php echo e($task->id); ?>">
                                                    <button type="submit" class="btn btn-sm btn-primary"><?php echo app('translator')->get('messages.apply'); ?></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\madel\NWPlv5\resources\views/home.blade.php ENDPATH**/ ?>