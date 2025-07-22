@extends('layouts.app')

@section('content')
<div>
    <h1>Checkout</h1>
    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
        @csrf
        <div>
            <div>
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>CEP</label>
                <input type="text" name="cep" id="cep" required>
            </div>
            <div>
                <label>Endereço</label>
                <input type="text" name="endereco" id="endereco" required>
            </div>
            <div>
                <label>Número</label>
                <input type="text" name="numero" required>
            </div>
            <div>
                <label>Bairro</label>
                <input type="text" name="bairro" id="bairro" required>
            </div>
            <div>
                <label>Cidade</label>
                <input type="text" name="cidade" id="cidade" required>
            </div>
            <div>
                <label>UF</label>
                <input type="text" name="uf" id="uf" required>
            </div>
        </div>
        <div>
            <h4>Resumo do Pedido</h4>
            <ul>
                @foreach($cart as $item)
                    <li>{{ $item['name'] }} x {{ $item['quantity'] }} (R$ {{ number_format($item['price'], 2, ',', '.') }})</li>
                @endforeach
            </ul>
            <p><strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
            <p><strong>Frete:</strong> R$ {{ number_format($frete, 2, ',', '.') }}</p>
            <p><strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>
            <input type="hidden" name="total" value="{{ $total }}">
            <button>Finalizar Pedido</button>
        </div>
    </form>
</div>
<script>
document.getElementById('cep').addEventListener('blur', function() {
    var cep = this.value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch('https://viacep.com.br/ws/' + cep + '/json/')
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('endereco').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('uf').value = data.uf;
                }
            });
    }
});
</script>
@endsection
