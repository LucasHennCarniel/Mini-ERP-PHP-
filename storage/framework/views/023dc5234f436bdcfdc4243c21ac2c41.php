

<?php $__env->startSection('content'); ?>
<div>
    <h1>Carrinho</h1>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Subtotal</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item['name']); ?></td>
                <td><?php echo e($item['quantity']); ?></td>
                <td>R$ <?php echo e(number_format($item['price'], 2, ',', '.')); ?></td>
                <td>R$ <?php echo e(number_format($item['price'] * $item['quantity'], 2, ',', '.')); ?></td>
                <td>
                    <form action="<?php echo e(route('cart.remove', $key)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button>Remover</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div>
        <strong>Subtotal:</strong> R$ <?php echo e(number_format($subtotal, 2, ',', '.')); ?><br>
        <strong>Frete:</strong> R$ <?php echo e(number_format($frete, 2, ',', '.')); ?><br>
        <strong>Total:</strong> R$ <?php echo e(number_format($total, 2, ',', '.')); ?>

    </div>
    <form action="<?php echo e(route('cart.clear')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button>Esvaziar Carrinho</button>
    </form>
    <a href="<?php echo e(route('checkout.show')); ?>">Finalizar Pedido</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/cart/index.blade.php ENDPATH**/ ?>