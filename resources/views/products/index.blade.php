@extends('layouts.app')

@section('content')
<div>
    <h1>Produtos</h1>
    <div>
        <a href="{{ route('products.create') }}">Novo Produto</a>
        <a href="{{ route('cart.index') }}">Ver Carrinho</a>
    </div>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if(session('pedido_finalizado'))
        <div>{{ session('pedido_finalizado') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Variações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                <td>
                    @foreach($product->variations as $variation)
                        <div>
                            {{ $variation->name }} (Estoque: {{ $variation->stock }})
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="variation_id" value="{{ $variation->id }}">
                                <input type="number" name="quantity" value="1" min="1">
                                <button>Comprar</button>
                            </form>
                        </div>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('products.edit', $product) }}">Editar</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button>Comprar Produto</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection