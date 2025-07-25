@extends('layouts.app')

@section('content')
<div class="main">
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Novo Cupom">
        Novo Cupom
    </h1>
    <form action="{{ route('coupons.store') }}" method="POST" style="max-width:400px;">
        @csrf
        <div style="margin-bottom: 16px;">
            <label for="code" style="font-weight:500;">Código:</label>
            <input type="text" name="code" id="code" class="form-control" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #ccc;">
        </div>
        <div style="margin-bottom: 16px;">
            <label for="discount" style="font-weight:500;">Desconto (%):</label>
            <input type="number" name="discount" id="discount" class="form-control" required style="width:100%;padding:8px;border-radius:6px;border:1px solid #ccc;">
        </div>
        <div style="margin-bottom: 16px;">
            <label for="expires_at" style="font-weight:500;">Validade:</label>
            <input type="date" name="expires_at" id="expires_at" class="form-control" style="width:100%;padding:8px;border-radius:6px;border:1px solid #ccc;">
        </div>
        <button type="submit" class="new-product" style="margin-top:18px;">Salvar</button>
    </form>
</div>
@endsection
