@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Produto</h1>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label>Preço</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
          <label>Estoque</label>
          <input type="number" name="stock" class="form-control" required>
        </div>
        <h4>Variações</h4>
        <div id="variations">
            @foreach($product->variations as $i => $variation)
            <div class="variation mb-2">
                <input type="text" name="variations[{{ $i }}][name]" value="{{ $variation->name }}" required>
                <button type="button" onclick="removeVariation(this)">Remover</button>
            </div>
            @endforeach
        </div>
        <button type="button" onclick="addVariation()">Adicionar Variação</button>
        <br><br>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<script>
let variationIndex = {{ count($product->variations) }};
function addVariation() {
    let html = `<div class=\"variation mb-2\">
        <input type=\"text\" name=\"variations[${variationIndex}][name]\" placeholder=\"Nome da variação\" required>
        <button type=\"button\" onclick=\"removeVariation(this)\">Remover</button>
    </div>`;
    document.getElementById('variations').insertAdjacentHTML('beforeend', html);
    variationIndex++;
}
function removeVariation(btn) {
    btn.parentElement.remove();
}
</script>
@endsection