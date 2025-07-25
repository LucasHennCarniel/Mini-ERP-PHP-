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
        <div>{{ session('success') }}</div>
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