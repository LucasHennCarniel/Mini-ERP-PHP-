@component('mail::message')
# Olá, {{ $pedido['nome'] }}!

Seu pedido de número <strong>{{ $pedido['order_id'] }}</strong> foi finalizado com sucesso.
Confira os detalhes abaixo:

## Dados do Pedido
- <strong>Nome:</strong> {{ $pedido['nome'] }}
- <strong>Email:</strong> {{ $pedido['email'] }}
- <strong>Endereço:</strong> {{ $pedido['endereco'] }}, {{ $pedido['numero'] }}<br>
  {{ $pedido['bairro'] }} - {{ $pedido['cidade'] }}/{{ $pedido['uf'] }}<br>
  CEP: {{ $pedido['cep'] }}

## Itens do Carrinho
| Produto | Preço | Quantidade | Subtotal |
|---------|-------|-----------|----------|
@foreach($cart as $item)
| {{ $item['name'] }} | R$ {{ number_format($item['price'], 2, ',', '.') }} | {{ $item['quantity'] }} | R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} |
@endforeach

**Subtotal:** R$ {{ number_format($subtotal, 2, ',', '.') }}  
**Frete:** R$ {{ number_format($frete, 2, ',', '.') }}  
**Total:** R$ {{ number_format($total, 2, ',', '.') }}

Se tiver dúvidas, entre em contato conosco.

Obrigado por comprar conosco!
@endcomponent
