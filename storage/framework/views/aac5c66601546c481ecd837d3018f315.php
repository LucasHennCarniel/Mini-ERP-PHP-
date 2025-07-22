

<?php $__env->startSection('content'); ?>
<div>
    <h1>Produtos</h1>
    <div>
        <a href="<?php echo e(route('products.create')); ?>">Novo Produto</a>
        <a href="<?php echo e(route('cart.index')); ?>">Ver Carrinho</a>
    </div>
    <?php if(session('success')): ?>
        <div><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('pedido_finalizado')): ?>
        <div><?php echo e(session('pedido_finalizado')); ?></div>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Variações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($product->name); ?></td>
                <td>R$ <?php echo e(number_format($product->price, 2, ',', '.')); ?></td>
                <td>
                    <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <?php echo e($variation->name); ?> (Estoque: <?php echo e($variation->stock); ?>)
                            <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                <input type="hidden" name="variation_id" value="<?php echo e($variation->id); ?>">
                                <input type="number" name="quantity" value="1" min="1">
                                <button>Comprar</button>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <a href="<?php echo e(route('products.edit', $product)); ?>">Editar</a>
                    <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                    <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button>Comprar Produto</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/products/index.blade.php ENDPATH**/ ?>