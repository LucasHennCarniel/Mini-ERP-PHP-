@extends('layouts.app')
@section('content')
<div>
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Carrinho">
        Carrinho
    </h1>
    <table class="table-products">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $key => $item)
            <tr>
                <td style="vertical-align: middle;">{{ $item['name'] }}</td>
                <td style="vertical-align: middle;">R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                <td style="vertical-align: middle;">{{ $item['quantity'] }}</td>
                <td style="vertical-align: middle;">R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 0; align-items: center; justify-content: center;">
                        <form action="{{ route('cart.remove', $key) }}" method="POST" style="display:inline-block; margin:0; padding:0;">
                            @csrf
                            <button type="submit" class="action-link delete" style="padding:0 8px; min-width:unset;">Remover</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex flex_c gap10" style="margin-top: 24px;">
        <div>
            <strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}<br>
        </div>
        
        <div>
             <strong>Frete:</strong> R$ {{ number_format($frete, 2, ',', '.') }}<br>
        </div>
        <div>
            @if(isset($discount) && $discount > 0)
            <strong>Desconto @if(isset($couponCode) && $couponCode) (Cupom: {{ $couponCode }}) @endif:</strong> -R$ {{ number_format($discount, 2, ',', '.') }}<br>
            @endif
        </div>
        <div>
            <strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}
        </div>
        
    </div>
    <div style="margin-top: 32px; margin-bottom: 16px;">
        <form action="{{ route('cart.applyCoupon') }}" method="POST" style="display: flex; gap: 12px; align-items: center; max-width: 400px;">
            @csrf
            <input type="text" name="coupon_code" placeholder="Código do cupom" required style="flex:1; padding:8px; border-radius:6px; border:1px solid #ccc;">
            <button type="submit" class="new-product" style="min-width:120px;">Aplicar Cupom</button>
        </form>
    </div>
    <div class="flex gap20 middle" >
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button class="btn-red" type="submit" style="widthwidth:13%;">Esvaziar Carrinho</button>
        </form>
        <a href="{{ route('checkout.show') }}" class="new-product finish-btn">Finalizar Compra</a>
    </div>
   
</div>
@endsection
