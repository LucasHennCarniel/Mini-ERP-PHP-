<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    
    <?php $__env->startSection('content'); ?>
    <div class="main">
        <h1 class="titleProducts">
            <img src="/css/img/pacote.png" style="height:24px;" alt="Editar Produto">
            Editar Produto
        </h1>
        <form class="checkout-form" action="<?php echo e(route('products.update', $product)); ?>" method="POST" style="max-width: 400px; margin-top: 24px;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="name" class="form-control" value="<?php echo e($product->name); ?>" required>
            </div>
            <div class="mb-3">
                <label>Preço</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?php echo e($product->price); ?>" required>
            </div>
            <div class="mb-3">
                <label>Estoque</label>
                <input type="number" name="stock" class="form-control" value="<?php echo e($product->stock); ?>" required>
            </div>
            <h4 style="margin-top:24px; margin-bottom:5px; font-size:1.1rem;">Variações</h4>
            <div id="variations">
                <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="variation mb-2">
                    <input type="text" name="variations[<?php echo e($i); ?>][name]" value="<?php echo e($variation->name); ?>" required>
                    <button class="btn-red" type="button" onclick="removeVariation(this)">Remover</button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button type="button" onclick="addVariation()" class="new-product" style="margin-bottom:18px; margin-top:10px;">Adicionar Variação</button>
            <br>
            <button type="submit" class="new-product" style="margin-top:18px;">Salvar</button>
        </form>
    </div>
    <script>
    let variationIndex = <?php echo e(count($product->variations)); ?>;
    function addVariation() {
        let html = `<div class=\"variation mb-2\">\n        <input type=\"text\" name=\"variations[${variationIndex}][name]\" placeholder=\"Nome da variação\" required>\n        <button class=\"btn-red\" type=\"button\" onclick=\"removeVariation(this)\" >Remover</button>\n    </div>`;
        document.getElementById('variations').insertAdjacentHTML('beforeend', html);
        variationIndex++;
    }
    function removeVariation(btn) {
        btn.parentElement.remove();
    }
    </script>
    <?php $__env->stopSection(); ?>
</body>
</html>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/products/edit.blade.php ENDPATH**/ ?>