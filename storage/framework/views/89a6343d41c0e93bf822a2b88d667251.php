
<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Novo Produto</h1>
    <form action="<?php echo e(route('products.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Preço</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Estoque</label>
          <input type="number" name="stock" class="form-control" required>
        </div>
        <h4>Variações</h4>
        <div id="variations">
            <div class="variation mb-2">
                <input type="text" name="variations[0][name]" placeholder="Nome da variação">
                <button type="button" onclick="removeVariation(this)">Remover</button>
            </div>
        </div>
        <button type="button" onclick="addVariation()">Adicionar Variação</button>
        <br><br>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<script>
let variationIndex = 1;
function addVariation() {
    let html = `<div class=\"variation mb-2\">\n        <input type=\"text\" name=\"variations[${variationIndex}][name]\" placeholder=\"Nome da variação\">\n        <button type=\"button\" onclick=\"removeVariation(this)\">Remover</button>\n    </div>`;
    document.getElementById('variations').insertAdjacentHTML('beforeend', html);
    variationIndex++;
}
function removeVariation(btn) {
    btn.parentElement.remove();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mini-erp-laravel\resources\views/products/create.blade.php ENDPATH**/ ?>