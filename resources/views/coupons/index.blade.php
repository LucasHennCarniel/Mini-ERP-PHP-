<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cupons</title>
</head>
<body>
    <div>
        <h1>Gerenciar Cupons</h1>
        <a href="{{ route('coupons.create') }}">Criar Cupom</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Desconto</th>
                    <th>Data de Expiração</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount }}%</td>
                    <td>{{ $coupon->expiration_date }}</td>
                    <td>
                        <a href="{{ route('coupons.edit', $coupon->id) }}">Editar</a>
                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>