@extends('layouts.app')
@section('content')
<div class="main">
    <h1 class="titleProducts">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Novo Produto">
        Novo Produto
    </h1>
    <form class="checkout-form " action="{{ route('products.store') }}" method="POST" style="max-width: 400px; margin-top: 24px;">
        @csrf
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

        <h4 style="margin-top:24px; margin-bottom:5px; font-size:1.1rem;">Variações</h4>
        <div id="variations">
            <div class="variation mb-2">
                <input type="text" name="variations[0][name]" placeholder="Nome da variação">
                <button class="btn-red" type="button" onclick="removeVariation(this)">Remover</button>
            </div>
        </div>
        <button type="button" onclick="addVariation()" class="new-product" style="margin-bottom:18px; margin-top:10px;">Adicionar Variação</button>
        <br>
        <button type="submit" class="new-product" style="margin-top:18px;">Salvar</button>
    </form>
</div>
<script>
let variationIndex = 1;
function addVariation() {
    let html = `<div class=\"variation mb-2\">\n        <input type=\"text\" name=\"variations[${variationIndex}][name]\" placeholder=\"Nome da variação\">\n        <button type=\"button\" onclick=\"removeVariation(this)\" >Remover</button>\n    </div>`;
    document.getElementById('variations').insertAdjacentHTML('beforeend', html);
    variationIndex++;
}
function removeVariation(btn) {
    btn.parentElement.remove();
}
</script>
@endsection