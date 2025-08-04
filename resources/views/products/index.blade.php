@extends('layouts.app')
@section('content')
<div>
    <h1 class="titleProducts">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Produtos">
        Produtos
    </h1>
    <div class="new-product-cart"> 
        <a class="new-product" href="{{ route('products.create') }}">
            + Novo  Produto</a>
        <a href="{{ route('cart.index') }}" class="cart">Ver Carrinho</a>
    </div>
    @if(session('success'))
        <div id="popup-alert" style="position:fixed;top:30px;left:50%;transform:translateX(-50%);z-index:9999;min-width:320px;max-width:90vw;background:#28a745;color:#fff;padding:18px 32px;border-radius:8px;box-shadow:0 4px 16px rgba(0,0,0,0.15);font-size:1.1rem;display:flex;align-items:center;gap:12px;">
            <span style="font-size:1.5rem;">&#10003;</span>
            <span>{{ session('success') }}</span>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('popup-alert').style.display = 'none';
            }, 2500);
        </script>
    @endif
    @if(session('pedido_finalizado'))
        <div>{{ session('pedido_finalizado') }}</div>
    @endif
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
            @foreach($products as $product)
            <tr>
                <td style="text-align:center; vertical-align: middle;">
                    <input type="checkbox" style="width:18px; height:18px;">
                </td>
                <td style="vertical-align: middle;">{{ $product->name }}</td>
                <td style="vertical-align: middle;">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                <td style="vertical-align: middle;">
                    @if(count($product->variations))
                        @foreach($product->variations as $variation)
                            <span>{{ $variation->name }} (Estoque: {{ $variation->stock }})</span><br>
                        @endforeach
                    @else
                        -
                    @endif
                </td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 16px; align-items: center; justify-content: center;">
                        <a href="{{ route('products.edit', $product->id) }}" class="action-link edit">Editar</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="action-link add" style="color: #388e3c;">Adicionar ao Carrinho</button>
                        </form>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-link delete" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection