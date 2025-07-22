<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <title>Gerenciar Pedidos</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Gerenciar Pedidos</h1>
        <a href="<?php echo e(route('orders.create')); ?>" class="btn btn-primary mb-3">Criar Novo Pedido</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->product->name); ?></td>
                        <td><?php echo e($order->quantity); ?></td>
                        <td><?php echo e(number_format($order->price, 2, ',', '.')); ?></td>
                        <td>
                            <a href="<?php echo e(route('orders.edit', $order->id)); ?>" class="btn btn-warning">Editar</a>
                            <form action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH C:\www\mini-erp-laravel\resources\views/orders/index.blade.php ENDPATH**/ ?>