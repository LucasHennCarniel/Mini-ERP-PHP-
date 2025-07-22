

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Estoque</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Variação</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($variation->product->name ?? '-'); ?></td>
                <td><?php echo e($variation->name); ?></td>
                <td><?php echo e($variation->stock); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\www\mini-erp-laravel\resources\views/stocks/index.blade.php ENDPATH**/ ?>