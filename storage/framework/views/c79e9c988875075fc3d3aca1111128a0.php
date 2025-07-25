<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Mini ERP Laravel</title>
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <nav >
                    <ul class="flex-container list">
                        
                        <span class="material-symbols-outlined" onclick="window.location='<?php echo e(url('/')); ?>'">home</span>
                        
                        <li class="custom-menu-item" onclick="window.location='<?php echo e(route('products.index')); ?>'">Produtos</li>
                        <li class="custom-menu-item" onclick="window.location='<?php echo e(route('stocks.index')); ?>'">Estoque</li>
                        <li class="custom-menu-item" onclick="window.location='<?php echo e(route('cart.index')); ?>'">Carrinho</li>
                        <li class="custom-menu-item" onclick="window.location='<?php echo e(route('checkout.show')); ?>'">Checkout</li>
                        <li class="custom-menu-item" onclick="window.location='<?php echo e(route('orders.index')); ?>'">Pedidos</li>
                        <li class="custom-menu-item" onclick="window.location='<?php echo e(route('coupons.index')); ?>'">Cupons</li>
                    </ul>
                </nav>
                <div class="container">
                    <di class="main">
                        <?php echo $__env->yieldContent('content'); ?>
                    </di>
                </div>
              
                <?php echo $__env->yieldPushContent('scripts'); ?>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>