

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h1>Criar Pedido</h1>
    <p>O cadastro de pedidos é feito automaticamente pelo checkout. Não é necessário criar pedidos manualmente.</p>
    <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-primary mt-3">Voltar para Pedidos</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/orders/create.blade.php ENDPATH**/ ?>