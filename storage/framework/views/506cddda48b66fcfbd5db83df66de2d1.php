

<?php $__env->startSection('content'); ?>
<div class="welcome-message">
    <h1>Bem-vindo ao Mini ERP!</h1>
    <p>Sistema de gestão empresarial moderno e futurista</p>
    
    <div class="welcome-features" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem; width: 100%; max-width: 1200px;">
        <div class="glass-card" style="padding: 2rem; text-align: center;">
            <span class="material-symbols-outlined" style="font-size: 3rem; color: var(--neon-blue); margin-bottom: 1rem; display: block;">inventory_2</span>
            <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Gestão de Produtos</h3>
            <p style="color: var(--text-secondary);">Controle completo do seu inventário com interface moderna e intuitiva.</p>
        </div>
        
        <div class="glass-card" style="padding: 2rem; text-align: center;">
            <span class="material-symbols-outlined" style="font-size: 3rem; color: var(--electric-blue); margin-bottom: 1rem; display: block;">shopping_cart</span>
            <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Sistema de Vendas</h3>
            <p style="color: var(--text-secondary);">Processo de vendas otimizado com carrinho inteligente e checkout rápido.</p>
        </div>
        
        <div class="glass-card" style="padding: 2rem; text-align: center;">
            <span class="material-symbols-outlined" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem; display: block;">analytics</span>
            <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Relatórios Avançados</h3>
            <p style="color: var(--text-secondary);">Acompanhe o desempenho do seu negócio com dashboards em tempo real.</p>
        </div>
    </div>
    
    <div style="margin-top: 3rem; display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
        <a href="<?php echo e(route('products.index')); ?>" class="btn-futuristic btn-primary">
            <span class="material-symbols-outlined">inventory_2</span>
            Ver Produtos
        </a>
        <a href="<?php echo e(route('cart.index')); ?>" class="btn-futuristic btn-success">
            <span class="material-symbols-outlined">shopping_cart</span>
            Abrir Carrinho
        </a>
    </div>
</div>

<style>
.welcome-features .glass-card:hover {
    transform: translateY(-10px) scale(1.02);
    border-color: var(--neon-blue);
}

.welcome-features .glass-card .material-symbols-outlined {
    animation: iconPulse 3s ease-in-out infinite;
}

@keyframes iconPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/welcome.blade.php ENDPATH**/ ?>