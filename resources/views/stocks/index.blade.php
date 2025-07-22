@extends('layouts.app')

@section('content')
<div>
    <h1>Estoque</h1>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Variação</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->product->name ?? '-' }}</td>
                <td>{{ $stock->variation->name ?? '-' }}</td>
                <td>{{ $stock->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection