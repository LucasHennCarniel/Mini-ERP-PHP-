

<?php $__env->startSection('content'); ?>
<div>
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Checkout">
        Checkout
    </h1>
    <table class="table-products">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="vertical-align: middle;"><?php echo e($item['name']); ?></td>
                <td style="vertical-align: middle;">R$ <?php echo e(number_format($item['price'], 2, ',', '.')); ?></td>
                <td style="vertical-align: middle;"><?php echo e($item['quantity']); ?></td>
                <td style="vertical-align: middle;">R$ <?php echo e(number_format($item['price'] * $item['quantity'], 2, ',', '.')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="flex flex_c gap10" style="margin-top:30px;">
        <div>
          <strong>Subtotal:</strong> R$ <?php echo e(number_format($subtotal, 2, ',', '.')); ?><br>
        </div>
        <div>
          <strong>Frete:</strong> R$ <?php echo e(number_format($frete, 2, ',', '.')); ?><br>
        </div>
        <div>
          <strong>Total:</strong> R$ <?php echo e(number_format($total, 2, ',', '.')); ?>

        </div>
        
    </div>
    <form action="<?php echo e(route('checkout.process')); ?>" method="POST" style="margin-top: 32px;">
        <?php echo csrf_field(); ?>
        <div>
            <div class="checkout-form">
                <label >Nome:</label>
                <input type="text" name="nome" required>
            </div>
            <div class="checkout-form">
                <label >Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="checkout-form">
                <label >CEP:</label>
                <input type="text" name="cep" id="cep" required>
            </div>
            <div class="checkout-form">
                <label >Endereço:</label>
                <input type="text" name="endereco" id="endereco" required>
            </div>
            <div class="checkout-form">
                <label >Número:</label>
                <input type="text" name="numero" required>
            </div>
            <div class="checkout-form">
                <label >Bairro:</label>
                <input type="text" name="bairro" id="bairro" required>
            </div>
            <div class="checkout-form">
                <label >Cidade:</label>
                <input type="text" name="cidade" id="cidade" required>
            </div>
            <div class="checkout-form">
                <label class="titleCheckount">UF:</label>
                <input type="text" name="uf" id="uf" required>
            </div>
        </div>
        <button class="new-product" type="submit">Finalizar Pedido</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var cepInput = document.getElementById('cep');
    if (cepInput) {
        cepInput.addEventListener('blur', function() {
            var cep = this.value.replace(/\D/g, '');
            if (cep.length === 8) {
                fetch('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('endereco').value = data.logradouro || '';
                            document.getElementById('bairro').value = data.bairro || '';
                            document.getElementById('cidade').value = data.localidade || '';
                            document.getElementById('uf').value = data.uf || '';
                        }
                    });
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/checkout/show.blade.php ENDPATH**/ ?>