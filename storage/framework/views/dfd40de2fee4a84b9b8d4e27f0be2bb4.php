<?php $__env->startSection('content'); ?>
<div>
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Pedidos">
        Gerenciar Pedidos
    </h1>
    <a class="new-product" href="<?php echo e(route('orders.create')); ?>" style="width:13%;"> + Criar Novo Pedido</a>
    <table class="table-products">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Produto(s)</th>
                <th>Quantidade</th>
                <th>Preço Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="vertical-align: middle;"><?php echo e($order->id); ?></td>
                <td style="vertical-align: middle;"><?php echo e($order->nome); ?></td>
                <td style="vertical-align: middle;">
                    <?php if($order->products && $order->products->count()): ?>
                        <?php echo e($order->products->pluck('name')->implode(', ')); ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td style="vertical-align: middle;">
                    <?php if($order->products && $order->products->count()): ?>
                        <?php echo e($order->products->sum('pivot.quantity')); ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td style="vertical-align: middle;">R$ <?php echo e(number_format($order->total ?? 0, 2, ',', '.')); ?></td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 16px; align-items: center; justify-content: center;">
                        <a href="<?php echo e(route('orders.edit', $order->id)); ?>" class="action-link edit">Editar</a>
                        <form action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display:inline;">
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/orders/index.blade.php ENDPATH**/ ?>