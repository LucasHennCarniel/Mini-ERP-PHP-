
<?php $__env->startSection('content'); ?>
<div class="main">
    <h1 class="titleProducts">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Editar Cupom">
        Editar Cupom
    </h1>
    <form class="checkout-form" action="<?php echo e(route('coupons.update', $coupon->id)); ?>" method="POST" style="max-width: 400px; margin-top: 24px;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="code" class="form-control" value="<?php echo e($coupon->code); ?>" required>
        </div>
        <div class="mb-3">
            <label>Desconto</label>
            <input type="text" name="discount" class="form-control" value="<?php echo e($coupon->discount); ?>" required>
        </div>
        <div class="mb-3">
            <label>Data de Expiração</label>
            <input type="date" name="expires_at" class="form-control" value="<?php echo e(isset($coupon->expires_at) ? date('Y-m-d', strtotime($coupon->expires_at)) : ''); ?>" required>
        </div>
        <button type="submit" class="new-product" style="margin-top:18px;">Salvar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/coupons/edit.blade.php ENDPATH**/ ?>