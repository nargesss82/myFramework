

<?php $__env->startSection('content'); ?>

    <h1>heloooo</h1>

    <?php echo e(\Asus\Core\Auth::user()->name); ?>


    <a href="/auth/logout">Logout</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\project8_mvc\my_framework\resources\views/panel/index.blade.php ENDPATH**/ ?>