@extends('layouts.app')
@section('content')
<div class="main" style="text-align:center; margin-top:60px;">
    <h1 style="color: #28a745; font-size:2rem;">Pedido finalizado com sucesso!</h1>
    <p style="margin-top:18px;">Seu pedido foi registrado e em breve você receberá um e-mail de confirmação.</p>
    <div style="margin-top:30px; display:flex; justify-content:center; gap:16px;">
        <a href="/" class="btn btn-primary">Voltar para a loja</a>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Ver meus pedidos</a>
    </div>
</div>
@endsection
