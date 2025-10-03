

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-title">
        <span class="material-symbols-outlined">shopping_cart</span>
        <h1>Carrinho de Compras</h1>
    </div>
    <div class="page-actions">
        <a href="<?php echo e(route('products.index')); ?>" class="btn-futuristic btn-secondary">
            <span class="material-symbols-outlined">arrow_back</span>
            Continuar Comprando
        </a>
        <?php if(!empty($cart) && count($cart) > 0): ?>
            <span class="cart-badge" style="position: static; background: linear-gradient(135deg, var(--primary-blue), var(--neon-blue)); padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem;">
                <?php echo e(count($cart)); ?> <?php echo e(count($cart) == 1 ? 'item' : 'itens'); ?>

            </span>
        <?php endif; ?>
    </div>
</div>

<?php if(empty($cart) || count($cart) == 0): ?>
    <div class="glass-card" style="padding: 3rem; text-align: center;">
        <span class="material-symbols-outlined" style="font-size: 5rem; color: var(--text-muted); margin-bottom: 1rem; display: block; opacity: 0.5;">shopping_cart</span>
        <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Seu carrinho está vazio</h3>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">Adicione alguns produtos para começar suas compras.</p>
        <a href="<?php echo e(route('products.index')); ?>" class="btn-futuristic btn-primary">
            <span class="material-symbols-outlined">inventory_2</span>
            Ver Produtos
        </a>
    </div>
<?php else: ?>
    <div class="glass-card" style="padding: 0; overflow: hidden; margin-bottom: 2rem;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="material-symbols-outlined" style="font-size: 20px;">inventory</span>
                            Produto
                        </div>
                    </th>
                    <th>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="material-symbols-outlined" style="font-size: 20px;">attach_money</span>
                            Preço Unitário
                        </div>
                    </th>
                    <th>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="material-symbols-outlined" style="font-size: 20px;">numbers</span>
                            Quantidade
                        </div>
                    </th>
                    <th>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="material-symbols-outlined" style="font-size: 20px;">calculate</span>
                            Subtotal
                        </div>
                    </th>
                    <th style="text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <span class="material-symbols-outlined" style="font-size: 20px;">settings</span>
                            Ações
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="cart-item">
                    <td style="vertical-align: middle;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--electric-blue), var(--primary-blue)); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="color: white; font-size: 24px;">inventory_2</span>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: var(--text-primary); font-size: 1.1rem;"><?php echo e($item['name']); ?></div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);">ID: #<?php echo e($key); ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="vertical-align: middle;">
                        <div style="font-weight: 600; font-size: 1.1rem; color: var(--text-blue);">
                            R$ <?php echo e(number_format($item['price'], 2, ',', '.')); ?>

                        </div>
                    </td>
                    <td style="vertical-align: middle;">
                        <div style="background: rgba(59, 130, 246, 0.1); padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid rgba(59, 130, 246, 0.3); display: inline-flex; align-items: center; justify-content: center; min-width: 60px;">
                            <span style="font-weight: 600; color: var(--text-primary);"><?php echo e($item['quantity']); ?></span>
                        </div>
                    </td>
                    <td style="vertical-align: middle;">
                        <div style="font-weight: 700; font-size: 1.2rem; color: var(--accent-success);">
                            R$ <?php echo e(number_format($item['price'] * $item['quantity'], 2, ',', '.')); ?>

                        </div>
                    </td>
                    <td style="vertical-align: middle; text-align: center;">
                        <form action="<?php echo e(route('cart.remove', $key)); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="action-btn delete" title="Remover item">
                                <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                Remover
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Resumo da compra -->
    <div class="glass-card" style="padding: 2rem; margin-bottom: 2rem;">
        <h3 style="color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <span class="material-symbols-outlined">receipt</span>
            Resumo do Pedido
        </h3>
        
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid rgba(59, 130, 246, 0.1);">
                <span style="color: var(--text-secondary);">Subtotal:</span>
                <span style="font-weight: 600; color: var(--text-primary);">R$ <?php echo e(number_format($subtotal, 2, ',', '.')); ?></span>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid rgba(59, 130, 246, 0.1);">
                <span style="color: var(--text-secondary);">Frete:</span>
                <span style="font-weight: 600; color: var(--text-primary);">R$ <?php echo e(number_format($frete, 2, ',', '.')); ?></span>
            </div>
            
            <?php if(isset($discount) && $discount > 0): ?>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid rgba(59, 130, 246, 0.1);">
                <span style="color: var(--accent-success);">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle;">local_offer</span>
                    Desconto <?php if(isset($couponCode) && $couponCode): ?> (Cupom: <?php echo e($couponCode); ?>) <?php endif; ?>:
                </span>
                <span style="font-weight: 600; color: var(--accent-success);">-R$ <?php echo e(number_format($discount, 2, ',', '.')); ?></span>
            </div>
            <?php endif; ?>
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-top: 2px solid var(--primary-blue); margin-top: 0.5rem;">
                <span style="font-size: 1.3rem; font-weight: 700; color: var(--text-primary);">Total:</span>
                <span style="font-size: 1.5rem; font-weight: 700; color: var(--neon-blue);">R$ <?php echo e(number_format($total, 2, ',', '.')); ?></span>
            </div>
        </div>
    </div>

    <!-- Formulário de cupom -->
    <div class="glass-card" style="padding: 2rem; margin-bottom: 2rem;">
        <h3 style="color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <span class="material-symbols-outlined">local_offer</span>
            Cupom de Desconto
        </h3>
        <form action="<?php echo e(route('cart.applyCoupon')); ?>" method="POST" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <?php echo csrf_field(); ?>
            <div style="flex: 1; min-width: 250px;">
                <input type="text" name="coupon_code" placeholder="Digite o código do cupom" required class="form-control" style="width: 100%;">
            </div>
            <button type="submit" class="btn-futuristic btn-success">
                <span class="material-symbols-outlined">redeem</span>
                Aplicar Cupom
            </button>
        </form>
    </div>

    <!-- Ações do carrinho -->
    <div style="display: flex; gap: 1rem; align-items: center; justify-content: center; flex-wrap: wrap;">
        <form action="<?php echo e(route('cart.clear')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="btn-futuristic btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja esvaziar o carrinho?')">
                <span class="material-symbols-outlined">delete_forever</span>
                Esvaziar Carrinho
            </button>
        </form>
        
        <a href="<?php echo e(route('checkout.show')); ?>" class="btn-futuristic btn-primary" style="font-size: 1.1rem; padding: 1.2rem 2rem;">
            <span class="material-symbols-outlined">payment</span>
            Finalizar Compra
        </a>
    </div>
<?php endif; ?>

<style>
.cart-item:hover {
    background: rgba(59, 130, 246, 0.05);
}

.cart-item td {
    transition: all var(--transition-smooth);
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .page-actions {
        justify-content: center;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.8rem 0.5rem;
        font-size: 0.85rem;
    }
    
    form {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-futuristic {
        justify-content: center;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/cart/index.blade.php ENDPATH**/ ?>