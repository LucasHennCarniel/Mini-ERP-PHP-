@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="page-title">
        <span class="material-symbols-outlined">payment</span>
        <h1>Checkout</h1>
    </div>
    <div class="page-actions">
        <a href="{{ route('cart.index') }}" class="btn-futuristic btn-secondary">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar ao Carrinho
        </a>
    </div>
</div>

<!-- Resumo do Pedido -->
<div class="glass-card" style="padding: 0; overflow: hidden; margin-bottom: 2rem;">
    <div style="background: linear-gradient(135deg, var(--dark-blue), var(--secondary-blue)); padding: 1.5rem; color: var(--text-primary);">
        <h3 style="margin: 0; display: flex; align-items: center; gap: 0.5rem;">
            <span class="material-symbols-outlined">receipt</span>
            Resumo do Pedido
        </h3>
    </div>
    
    <table class="data-table" style="border: none; border-radius: 0;">
        <thead>
            <tr>
                <th>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="material-symbols-outlined" style="font-size: 20px;">inventory</span>
                        Produto
                    </div>
                </th>
                <th>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="material-symbols-outlined" style="font-size: 20px;">attach_money</span>
                        Preço
                    </div>
                </th>
                <th>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="material-symbols-outlined" style="font-size: 20px;">numbers</span>
                        Quantidade
                    </div>
                </th>
                <th>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="material-symbols-outlined" style="font-size: 20px;">calculate</span>
                        Subtotal
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td style="vertical-align: middle;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--electric-blue), var(--primary-blue)); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <span class="material-symbols-outlined" style="color: white; font-size: 20px;">inventory_2</span>
                        </div>
                        <span style="font-weight: 500;">{{ $item['name'] }}</span>
                    </div>
                </td>
                <td style="vertical-align: middle;">
                    <span style="color: var(--text-blue); font-weight: 600;">R$ {{ number_format($item['price'], 2, ',', '.') }}</span>
                </td>
                <td style="vertical-align: middle;">
                    <div style="background: rgba(59, 130, 246, 0.1); padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid rgba(59, 130, 246, 0.3); display: inline-flex; align-items: center; justify-content: center; min-width: 60px;">
                        <span style="font-weight: 600;">{{ $item['quantity'] }}</span>
                    </div>
                </td>
                <td style="vertical-align: middle;">
                    <span style="color: var(--accent-success); font-weight: 700; font-size: 1.1rem;">R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="padding: 1.5rem; background: rgba(59, 130, 246, 0.05); border-top: 1px solid rgba(59, 130, 246, 0.2);">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0;">
                <span style="color: var(--text-secondary);">Subtotal:</span>
                <span style="font-weight: 600; color: var(--text-primary);">R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0;">
                <span style="color: var(--text-secondary);">Frete:</span>
                <span style="font-weight: 600; color: var(--text-primary);">R$ {{ number_format($frete, 2, ',', '.') }}</span>
            </div>
            
            @if(isset($discount) && $discount > 0)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0;">
                <span style="color: var(--accent-success);">Desconto:</span>
                <span style="font-weight: 600; color: var(--accent-success);">-R$ {{ number_format($discount, 2, ',', '.') }}</span>
            </div>
            @endif
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-top: 2px solid var(--primary-blue); margin-top: 0.5rem;">
                <span style="font-size: 1.2rem; font-weight: 700; color: var(--text-primary);">Total:</span>
                <span style="font-size: 1.4rem; font-weight: 700; color: var(--neon-blue);">R$ {{ number_format($total, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Formulário de Dados -->
<form action="{{ route('checkout.process') }}" method="POST">
    @csrf
    <div class="glass-card" style="padding: 2rem; margin-bottom: 2rem;">
        <h3 style="color: var(--text-primary); margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;">
            <span class="material-symbols-outlined">person</span>
            Dados do Cliente
        </h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">person</span>
                    Nome Completo
                </label>
                <input type="text" name="nome" class="form-control" placeholder="Digite seu nome completo" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">email</span>
                    E-mail
                </label>
                <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
            </div>
        </div>
    </div>
    
    <div class="glass-card" style="padding: 2rem; margin-bottom: 2rem;">
        <h3 style="color: var(--text-primary); margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;">
            <span class="material-symbols-outlined">location_on</span>
            Endereço de Entrega
        </h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">pin_drop</span>
                    CEP
                </label>
                <input type="text" name="cep" id="cep" class="form-control" placeholder="00000-000" required>
            </div>
            
            <div class="form-group" style="grid-column: span 2;">
                <label class="form-label">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">home</span>
                    Endereço
                </label>
                <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Rua, Avenida, etc." required>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">tag</span>
                    Número
                </label>
                <input type="text" name="numero" class="form-control" placeholder="123" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">apartment</span>
                    Bairro
                </label>
                <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Nome do bairro" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">location_city</span>
                    Cidade
                </label>
                <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Nome da cidade" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">map</span>
                    UF
                </label>
                <input type="text" name="uf" id="uf" class="form-control" placeholder="SP" maxlength="2" required>
            </div>
        </div>
    </div>
    
    <div style="display: flex; gap: 1rem; justify-content: center; align-items: center; flex-wrap: wrap;">
        <a href="{{ route('cart.index') }}" class="btn-futuristic btn-secondary">
            <span class="material-symbols-outlined">arrow_back</span>
            Voltar ao Carrinho
        </a>
        
        <button type="submit" class="btn-futuristic btn-success" style="font-size: 1.1rem; padding: 1.2rem 2.5rem;">
            <span class="material-symbols-outlined">check_circle</span>
            Finalizar Pedido
        </button>
    </div>
</form>

<style>
.form-group input:focus {
    border-color: var(--neon-blue) !important;
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2) !important;
}

#cep {
    position: relative;
}

#cep:after {
    content: 'Preencha o CEP para buscar o endereço automaticamente';
    position: absolute;
    bottom: -1.5rem;
    left: 0;
    font-size: 0.8rem;
    color: var(--text-muted);
}

.loading-cep {
    position: relative;
}

.loading-cep:after {
    content: '🔄 Buscando endereço...';
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.8rem;
    color: var(--primary-blue);
}

@media (max-width: 768px) {
    .form-group {
        grid-column: span 1 !important;
    }
    
    .glass-card {
        padding: 1.5rem !important;
    }
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var cepInput = document.getElementById('cep');
    if (cepInput) {
        // Máscara para CEP
        cepInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length <= 8) {
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
                this.value = value;
            }
        });
        
        // Busca automática do endereço
        cepInput.addEventListener('blur', function() {
            var cep = this.value.replace(/\D/g, '');
            if (cep.length === 8) {
                this.classList.add('loading-cep');
                
                fetch('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(response => response.json())
                    .then(data => {
                        this.classList.remove('loading-cep');
                        if (!data.erro) {
                            document.getElementById('endereco').value = data.logradouro || '';
                            document.getElementById('bairro').value = data.bairro || '';
                            document.getElementById('cidade').value = data.localidade || '';
                            document.getElementById('uf').value = data.uf || '';
                            
                            // Animação de sucesso
                            ['endereco', 'bairro', 'cidade', 'uf'].forEach(id => {
                                const input = document.getElementById(id);
                                if (input.value) {
                                    input.style.borderColor = 'var(--accent-success)';
                                    setTimeout(() => {
                                        input.style.borderColor = '';
                                    }, 2000);
                                }
                            });
                        } else {
                            alert('CEP não encontrado. Por favor, verifique e tente novamente.');
                        }
                    })
                    .catch(error => {
                        this.classList.remove('loading-cep');
                        console.error('Erro ao buscar CEP:', error);
                    });
            }
        });
    }
    
    // Máscara para UF (somente letras)
    const ufInput = document.getElementById('uf');
    if (ufInput) {
        ufInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '');
        });
    }
});
</script>
@endpush
