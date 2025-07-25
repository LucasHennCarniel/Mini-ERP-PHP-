@extends('layouts.app')
@section('content')
<div>
    <h1 class="titleProducts" style="margin-bottom: 24px;">
        <img src="/css/img/pacote.png" style="height:24px;" alt="Cupons">
        Cupons
    </h1>
    <a class="new-product" href="{{ route('coupons.create') }}" style="width:10%;">+ Novo Cupom</a>
    <table class="table-products">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Desconto</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $coupon)
            <tr>
                <td style="vertical-align: middle;">{{ $coupon->id }}</td>
                <td style="vertical-align: middle;">{{ $coupon->code }}</td>
                <td style="vertical-align: middle;">{{ $coupon->discount }}%</td>
                <td style="vertical-align: middle;">{{ $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('d/m/Y') : '-' }}</td>
                <td style="vertical-align: middle; white-space: nowrap;">
                    <div style="display: flex; gap: 16px; align-items: center; justify-content: center;">
                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="action-link edit">Editar</a>
                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline;">
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