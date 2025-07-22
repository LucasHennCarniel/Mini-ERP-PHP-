<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <title>Gerenciar Cupons</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Gerenciar Cupons</h1>
        <a href="<?php echo e(route('coupons.create')); ?>" class="btn btn-primary mb-3">Criar Cupom</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Desconto</th>
                    <th>Data de Expiração</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($coupon->id); ?></td>
                    <td><?php echo e($coupon->code); ?></td>
                    <td><?php echo e($coupon->discount); ?>%</td>
                    <td><?php echo e($coupon->expiration_date); ?></td>
                    <td>
                        <a href="<?php echo e(route('coupons.edit', $coupon->id)); ?>" class="btn btn-warning">Editar</a>
                        <form action="<?php echo e(route('coupons.destroy', $coupon->id)); ?>" method="POST" style="display:inline;">
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
</html><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/coupons/index.blade.php ENDPATH**/ ?>