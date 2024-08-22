
<?php $__env->startSection('title','create article'); ?>
<?php $__env->startSection('content'); ?>
<h2><?php echo e($title); ?></h2>
<h3><?php echo e($title2); ?></h3>
<?php if($auth): ?>{
<span>you are logged in</span>
}
<?php else: ?>{
<span>you are not logged in</span>
}
<?php endif; ?>
<form action="/article/createeee" method="post">
    <input type="text" name="title" placeholder="enter title">
    <button type="submit">create</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\ridanmvc\tamrin_composer\resources\views/articles/create.blade.php ENDPATH**/ ?>