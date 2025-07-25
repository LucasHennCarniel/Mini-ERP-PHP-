<?php $__env->startSection('content'); ?>
<div>
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Cupons">
        Cupons
    </h1>
    <a class="new-product" href="<?php echo e(route('coupons.create')); ?>" style="width:10%;">+ Novo Cupom</a>
    <table class="table-products">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Desconto</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="vertical-align: middle;"><?php echo e($coupon->id); ?></td>
                <td style="vertical-align: middle;"><?php echo e($coupon->code); ?></td>
                <td style="vertical-align: middle;"><?php echo e($coupon->discount); ?>%</td>
                <td style="vertical-align: middle;"><?php echo e($coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('d/m/Y') : '-'); ?></td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 16px; align-items: center; justify-content: center;">
                        <a href="<?php echo e(route('coupons.edit', $coupon->id)); ?>" class="action-link edit">Editar</a>
                        <form action="<?php echo e(route('coupons.destroy', $coupon->id)); ?>" method="POST" style="display:inline;">
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/coupons/index.blade.php ENDPATH**/ ?>