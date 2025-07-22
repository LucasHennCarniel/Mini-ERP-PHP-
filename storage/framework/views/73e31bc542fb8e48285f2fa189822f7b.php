

<?php $__env->startSection('content'); ?>
<div>
    <h1>Checkout</h1>
    <form action="<?php echo e(route('checkout.process')); ?>" method="POST" id="checkout-form">
        <?php echo csrf_field(); ?>
        <div>
            <div>
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>CEP</label>
                <input type="text" name="cep" id="cep" required>
            </div>
            <div>
                <label>Endereço</label>
                <input type="text" name="endereco" id="endereco" required>
            </div>
            <div>
                <label>Número</label>
                <input type="text" name="numero" required>
            </div>
            <div>
                <label>Bairro</label>
                <input type="text" name="bairro" id="bairro" required>
            </div>
            <div>
                <label>Cidade</label>
                <input type="text" name="cidade" id="cidade" required>
            </div>
            <div>
                <label>UF</label>
                <input type="text" name="uf" id="uf" required>
            </div>
        </div>
        <div>
            <h4>Resumo do Pedido</h4>
            <ul>
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($item['name']); ?> x <?php echo e($item['quantity']); ?> (R$ <?php echo e(number_format($item['price'], 2, ',', '.')); ?>)</li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <p><strong>Subtotal:</strong> R$ <?php echo e(number_format($subtotal, 2, ',', '.')); ?></p>
            <p><strong>Frete:</strong> R$ <?php echo e(number_format($frete, 2, ',', '.')); ?></p>
            <p><strong>Total:</strong> R$ <?php echo e(number_format($total, 2, ',', '.')); ?></p>
            <input type="hidden" name="total" value="<?php echo e($total); ?>">
            <button>Finalizar Pedido</button>
        </div>
    </form>
</div>
<script>
document.getElementById('cep').addEventListener('blur', function() {
    var cep = this.value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch('https://viacep.com.br/ws/' + cep + '/json/')
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('endereco').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('uf').value = data.uf;
                }
            });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/checkout/show.blade.php ENDPATH**/ ?>