
<?php $__env->startSection('content'); ?>
<div>
    <h1 class="titleProducts">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Produtos">
        Produtos
    </h1>
    <div class="new-product-cart"> 
        <a class="new-product" href="<?php echo e(route('products.create')); ?>">
            + Novo  Produto</a>
        <a href="<?php echo e(route('cart.index')); ?>" class="cart">Ver Carrinho</a>
    </div>
    <?php if(session('success')): ?>
        <div id="popup-alert" style="position:fixed;top:30px;left:50%;transform:translateX(-50%);z-index:9999;min-width:320px;max-width:90vw;background:#28a745;color:#fff;padding:18px 32px;border-radius:8px;box-shadow:0 4px 16px rgba(0,0,0,0.15);font-size:1.1rem;display:flex;align-items:center;gap:12px;">
            <span style="font-size:1.5rem;">&#10003;</span>
            <span><?php echo e(session('success')); ?></span>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('popup-alert').style.display = 'none';
            }, 2500);
        </script>
    <?php endif; ?>
    <?php if(session('pedido_finalizado')): ?>
        <div><?php echo e(session('pedido_finalizado')); ?></div>
    <?php endif; ?>
    <table class="table-products">
        <thead>
            <tr>
                <th style="width:40px; text-align:center;">Selecionar</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Variações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="text-align:center; vertical-align: middle;">
                    <input type="checkbox" style="width:18px; height:18px;">
                </td>
                <td style="vertical-align: middle;"><?php echo e($product->name); ?></td>
                <td style="vertical-align: middle;">R$ <?php echo e(number_format($product->price, 2, ',', '.')); ?></td>
                <td style="vertical-align: middle;">
                    <?php if(count($product->variations)): ?>
                        <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span><?php echo e($variation->name); ?> (Estoque: <?php echo e($variation->stock); ?>)</span><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 16px; align-items: center; justify-content: center;">
                        <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="action-link edit">Editar</a>
                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                            <button type="submit" class="action-link add" style="color: #388e3c;">Adicionar ao Carrinho</button>
                        </form>
                        <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="action-link delete" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/products/index.blade.php ENDPATH**/ ?>