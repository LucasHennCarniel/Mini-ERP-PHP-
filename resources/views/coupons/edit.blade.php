@extends('layouts.app')
@section('content')
<div class="main">
    <h1 class="titleProducts">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Editar Cupom">
        Editar Cupom
    </h1>
    <form class="checkout-form" action="{{ route('coupons.update', $coupon->id) }}" method="POST" style="max-width: 400px; margin-top: 24px;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="code" class="form-control" value="{{ $coupon->code }}" required>
        </div>
        <div class="mb-3">
            <label>Desconto</label>
            <input type="text" name="discount" class="form-control" value="{{ $coupon->discount }}" required>
        </div>
        <div class="mb-3">
            <label>Data de Expiração</label>
            <input type="date" name="expires_at" class="form-control" value="{{ isset($coupon->expires_at) ? date('Y-m-d', strtotime($coupon->expires_at)) : '' }}" required>
        </div>
        <button type="submit" class="new-product" style="margin-top:18px;">Salvar</button>
    </form>
</div>
@endsection
