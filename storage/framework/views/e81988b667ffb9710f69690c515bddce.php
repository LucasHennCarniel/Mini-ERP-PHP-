<?php $__env->startComponent('mail::message'); ?>
# Olá, <?php echo e($pedido['nome']); ?>!

Seu pedido foi realizado com sucesso. Confira os detalhes abaixo:

## Dados do Pedido
- <strong>Nome:</strong> <?php echo e($pedido['nome']); ?>

- <strong>Email:</strong> <?php echo e($pedido['email']); ?>

- <strong>Endereço:</strong> <?php echo e($pedido['endereco']); ?>, <?php echo e($pedido['numero']); ?><br>
  <?php echo e($pedido['bairro']); ?> - <?php echo e($pedido['cidade']); ?>/<?php echo e($pedido['uf']); ?><br>
  CEP: <?php echo e($pedido['cep']); ?>


## Itens do Carrinho
| Produto | Preço | Quantidade | Subtotal |
|---------|-------|-----------|----------|
<?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
| <?php echo e($item['name']); ?> | R$ <?php echo e(number_format($item['price'], 2, ',', '.')); ?> | <?php echo e($item['quantity']); ?> | R$ <?php echo e(number_format($item['price'] * $item['quantity'], 2, ',', '.')); ?> |
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

**Subtotal:** R$ <?php echo e(number_format($subtotal, 2, ',', '.')); ?>  
**Frete:** R$ <?php echo e(number_format($frete, 2, ',', '.')); ?>  
**Total:** R$ <?php echo e(number_format($total, 2, ',', '.')); ?>


Se tiver dúvidas, entre em contato conosco.

Obrigado por comprar conosco!
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/emails/pedido.blade.php ENDPATH**/ ?>