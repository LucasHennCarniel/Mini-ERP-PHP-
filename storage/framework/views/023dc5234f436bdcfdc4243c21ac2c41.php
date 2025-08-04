
<?php $__env->startSection('content'); ?>
<div>
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Carrinho">
        Carrinho
    </h1>
    <table class="table-products">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="vertical-align: middle;"><?php echo e($item['name']); ?></td>
                <td style="vertical-align: middle;">R$ <?php echo e(number_format($item['price'], 2, ',', '.')); ?></td>
                <td style="vertical-align: middle;"><?php echo e($item['quantity']); ?></td>
                <td style="vertical-align: middle;">R$ <?php echo e(number_format($item['price'] * $item['quantity'], 2, ',', '.')); ?></td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 0; align-items: center; justify-content: center;">
                        <form action="<?php echo e(route('cart.remove', $key)); ?>" method="POST" style="display:inline-block; margin:0; padding:0;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="action-link delete" style="padding:0 8px; min-width:unset;">Remover</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="flex flex_c gap10" style="margin-top: 24px;">
        <div>
            <strong>Subtotal:</strong> R$ <?php echo e(number_format($subtotal, 2, ',', '.')); ?><br>
        </div>
        
        <div>
             <strong>Frete:</strong> R$ <?php echo e(number_format($frete, 2, ',', '.')); ?><br>
        </div>
        <div>
            <?php if(isset($discount) && $discount > 0): ?>
            <strong>Desconto <?php if(isset($couponCode) && $couponCode): ?> (Cupom: <?php echo e($couponCode); ?>) <?php endif; ?>:</strong> -R$ <?php echo e(number_format($discount, 2, ',', '.')); ?><br>
            <?php endif; ?>
        </div>
        <div>
            <strong>Total:</strong> R$ <?php echo e(number_format($total, 2, ',', '.')); ?>

        </div>
        
    </div>
    <div style="margin-top: 32px; margin-bottom: 16px;">
        <form action="<?php echo e(route('cart.applyCoupon')); ?>" method="POST" style="display: flex; gap: 12px; align-items: center; max-width: 400px;">
            <?php echo csrf_field(); ?>
            <input type="text" name="coupon_code" placeholder="Código do cupom" required style="flex:1; padding:8px; border-radius:6px; border:1px solid #ccc;">
            <button type="submit" class="new-product" style="min-width:120px;">Aplicar Cupom</button>
        </form>
    </div>
    <div class="flex gap20 middle" >
        <form action="<?php echo e(route('cart.clear')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="btn-red" type="submit" style="widthwidth:13%;">Esvaziar Carrinho</button>
        </form>
        <?php if(empty($cart) || count($cart) == 0): ?>
            <button class="new-product finish-btn" disabled style="opacity:0.6;cursor:not-allowed;">Finalizar Compra</button>
        <?php else: ?>
            <a href="<?php echo e(route('checkout.show')); ?>" class="new-product finish-btn">Finalizar Compra</a>
        <?php endif; ?>
    </div>
   
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/cart/index.blade.php ENDPATH**/ ?>