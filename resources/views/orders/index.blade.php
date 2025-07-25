@extends('layouts.app')
@section('content')
<div>
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Pedidos">
        Gerenciar Pedidos
    </h1>
    <a class="new-product" href="{{ route('orders.create') }}" style="width:13%;"> + Criar Novo Pedido</a>
    <table class="table-products">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Produto(s)</th>
                <th>Quantidade</th>
                <th>Preço Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td style="vertical-align: middle;">{{ $order->id }}</td>
                <td style="vertical-align: middle;">{{ $order->nome }}</td>
                <td style="vertical-align: middle;">
                    @if($order->products && $order->products->count())
                        {{ $order->products->pluck('name')->implode(', ') }}
                    @else
                        -
                    @endif
                </td>
                <td style="vertical-align: middle;">
                    @if($order->products && $order->products->count())
                        {{ $order->products->sum('pivot.quantity') }}
                    @else
                        -
                    @endif
                </td>
                <td style="vertical-align: middle;">R$ {{ number_format($order->total ?? 0, 2, ',', '.') }}</td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 16px; align-items: center; justify-content: center;">
                        <a href="{{ route('orders.edit', $order->id) }}" class="action-link edit">Editar</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-link delete">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection