@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Criar Pedido</h1>
    <p>O cadastro de pedidos é feito automaticamente pelo checkout. Não é necessário criar pedidos manualmente.</p>
    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">Voltar para Pedidos</a>
</div>
@endsection
