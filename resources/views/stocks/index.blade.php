@extends('layouts.app')
@section('content')
<div class="main">
    <h1 class="titleProducts">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Estoque">
        Estoque
    </h1>
    <div class="new-product-cart">
        <a class="new-product" href="{{ route('products.create') }}">
            + Novo Estoque</a>
    </div>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table class="table-products">
        <thead>
            <tr>
                <th style="width:40px; text-align:center;">ID</th>
                <th>Produto</th>
                <th>Variação</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td style="text-align:center; vertical-align: middle;">{{ $stock->id }}</td>
                <td style="vertical-align: middle;">{{ $stock->product->name ?? '-' }}</td>
                <td style="vertical-align: middle;">{{ $stock->variation->name ?? '-' }}</td>
                <td style="vertical-align: middle;">{{ $stock->quantity }}</td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 16px; align-items: center; justify-content: center;">
                        <a href="{{ route('stocks.edit', $stock->id) }}" class="action-link edit">Editar</a>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
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