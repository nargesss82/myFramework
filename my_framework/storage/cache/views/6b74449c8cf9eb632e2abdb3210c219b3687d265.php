

<?php $__env->startSection('content'); ?>
    <form action="/auth/register" method="post" class="space-y-2 ">
        <div>
            <label for="name" >Name: </label>
            <input type="text" name="name" class="border-2 border-red-400" value="<?php echo e($old('name')); ?>">
            <?php if($errors->has('name')): ?>
                <span><?php echo e($errors->first('name')); ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="text" name="email" class="border-2 border-red-400" value="<?php echo e($old('email')); ?>">
            <?php if($errors->has('email')): ?>
                <span><?php echo e($errors->first('email')); ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" class="border-2 border-red-400" value="<?php echo e($old('password')); ?>">
            <?php if($errors->has('password')): ?>
                <span><?php echo e($errors->first('password')); ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="confirm_password">Confirm Password: </label>
            <input type="password" name="confirm_password" class="border-2 border-red-400" value="<?php echo e($old('confirm_password')); ?>">
            <?php if($errors->has('confirm_password')): ?>
                <span><?php echo e($errors->first('confirm_password')); ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="bg-blue-400 p-2 text-white rounded">Register</button>
    </form>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\project8_mvc\my_framework\resources\views/auth/register.blade.php ENDPATH**/ ?>