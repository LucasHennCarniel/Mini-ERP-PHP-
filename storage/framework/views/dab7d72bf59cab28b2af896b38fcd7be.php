
<?php $__env->startSection('content'); ?>
<div class="main">
    <h1 class="titleProducts">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Estoque">
        Estoque
    </h1>
    <div class="new-product-cart">
        <a class="new-product" href="<?php echo e(route('products.create')); ?>">
            + Novo Estoque</a>
    </div>
    <?php if(session('success')): ?>
        <div><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <table class="table-products">
        <thead>
            <tr>
                <th style="width:40px; text-align:center;">ID</th>
                <th>Produto</th>
                <th>Variação</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="text-align:center; vertical-align: middle;"><?php echo e($stock->id); ?></td>
                <td style="vertical-align: middle;"><?php echo e($stock->product->name ?? '-'); ?></td>
                <td style="vertical-align: middle;"><?php echo e($stock->variation->name ?? '-'); ?></td>
                <td style="vertical-align: middle;"><?php echo e($stock->quantity); ?></td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 16px; align-items: center; justify-content: center;">
                        <a href="<?php echo e(route('stocks.edit', $stock->id)); ?>" class="action-link edit">Editar</a>
                        <form action="<?php echo e(route('stocks.destroy', $stock->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="action-link delete">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/stocks/index.blade.php ENDPATH**/ ?>