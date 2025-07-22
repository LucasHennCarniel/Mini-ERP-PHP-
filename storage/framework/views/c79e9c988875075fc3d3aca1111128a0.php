<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mini ERP Laravel</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/erp.css">
</head>
<body>
    <nav class="custom-menu">
        <span class="custom-menu-home" onclick="window.location='<?php echo e(url('/')); ?>'" title="Início">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 2 7.5V14a1 1 0 0 0 1 1h3.5a.5.5 0 0 0 .5-.5V11a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3.5a.5.5 0 0 0 .5.5H13a1 1 0 0 0 1-1V7.5a.5.5 0 0 0-.146-.354l-6-6z"/>
            </svg>
        </span>
        <div class="custom-menu-item" onclick="window.location='<?php echo e(route('products.index')); ?>'">Produtos</div>
        <div class="custom-menu-item" onclick="window.location='<?php echo e(route('stocks.index')); ?>'">Estoque</div>
        <div class="custom-menu-item" onclick="window.location='<?php echo e(route('cart.index')); ?>'">Carrinho</div>
        <div class="custom-menu-item" onclick="window.location='<?php echo e(route('checkout.show')); ?>'">Checkout</div>
        <div class="custom-menu-item" onclick="window.location='<?php echo e(route('orders.index')); ?>'">Pedidos</div>
        <div class="custom-menu-item" onclick="window.location='<?php echo e(route('coupons.index')); ?>'">Cupons</div>
    </nav>
    <?php echo $__env->yieldContent('content'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>