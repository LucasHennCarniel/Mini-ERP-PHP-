

<?php $__env->startSection('content'); ?>
<div class="main">
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Novo Cupom">
        Novo Cupom
    </h1>
    <form action="<?php echo e(route('coupons.store')); ?>" method="POST" style="max-width:400px;">
        <?php echo csrf_field(); ?>
        <div style="margin-bottom: 16px;">
            <label for="code" style="font-weight:500;">Código:</label>
            <input type="text" name="code" id="code" class="form-control" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #ccc;">
        </div>
        <div style="margin-bottom: 16px;">
            <label for="discount" style="font-weight:500;">Desconto (%):</label>
            <input type="number" name="discount" id="discount" class="form-control" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #ccc;">
        </div>
        <div style="margin-bottom: 16px;">
            <label for="expires_at" style="font-weight:500;">Validade:</label>
            <input type="date" name="expires_at" id="expires_at" class="form-control" style="width:100%;padding:8px;border-radius:6px;border:1px solid #ccc;">
        </div>
        <button type="submit" class="new-product" style="margin-top:18px;">Salvar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/coupons/create.blade.php ENDPATH**/ ?>