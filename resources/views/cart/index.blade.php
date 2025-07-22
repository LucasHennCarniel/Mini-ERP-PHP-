@extends('layouts.app')

@section('content')
<div>
    <h1>Carrinho</h1>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Subtotal</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $key => $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                <td>R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.remove', $key) }}" method="POST">
                        @csrf
                        <button>Remover</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}<br>
        <strong>Frete:</strong> R$ {{ number_format($frete, 2, ',', '.') }}<br>
        <strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}
    </div>
    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button>Esvaziar Carrinho</button>
    </form>
    <a href="{{ route('checkout.show') }}">Finalizar Pedido</a>
</div>
@endsection
