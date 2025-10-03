@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="page-title">
        <span class="material-symbols-outlined">inventory_2</span>
        <h1>Produtos</h1>
    </div>
    <div class="page-actions">
        <a href="{{ route('products.create') }}" class="btn-futuristic btn-success">
            <span class="material-symbols-outlined">add</span>
            Novo Produto
        </a>
        <a href="{{ route('cart.index') }}" class="btn-futuristic btn-primary">
            <span class="material-symbols-outlined">shopping_cart</span>
            Ver Carrinho
            @if(session('cart') && count(session('cart')) > 0)
                <span class="cart-badge">{{ count(session('cart')) }}</span>
            @endif
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <span class="material-symbols-outlined">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('pedido_finalizado'))
    <div class="alert alert-info">
        <span class="material-symbols-outlined">info</span>
        <span>{{ session('pedido_finalizado') }}</span>
    </div>
@endif

<div class="glass-card" style="padding: 0; overflow: hidden;">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 60px; text-align: center;">
                    <input type="checkbox" class="custom-checkbox" id="selectAll">
                </th>
                <th>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="material-symbols-outlined" style="font-size: 20px;">inventory</span>
                        Nome do Produto
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
                        <span class="material-symbols-outlined" style="font-size: 20px;">tune</span>
                        Variações
                    </div>
                </th>
                <th style="text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <span class="material-symbols-outlined" style="font-size: 20px;">settings</span>
                        Ações
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="product-row">
                <td style="text-align: center; vertical-align: middle;">
                    <input type="checkbox" class="custom-checkbox product-checkbox" value="{{ $product->id }}">
                </td>
                <td style="vertical-align: middle;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--primary-blue), var(--neon-blue)); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <span class="material-symbols-outlined" style="color: white; font-size: 20px;">inventory_2</span>
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--text-primary);">{{ $product->name }}</div>
                            <div style="font-size: 0.85rem; color: var(--text-muted);">ID: #{{ $product->id }}</div>
                        </div>
                    </div>
                </td>
                <td style="vertical-align: middle;">
                    <div style="font-weight: 600; font-size: 1.1rem; color: var(--accent-success);">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </div>
                </td>
                <td style="vertical-align: middle;">
                    @if(count($product->variations))
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            @foreach($product->variations as $variation)
                                <div style="background: rgba(59, 130, 246, 0.1); padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid rgba(59, 130, 246, 0.2);">
                                    <span style="font-weight: 500;">{{ $variation->name }}</span>
                                    <span style="color: var(--text-muted); margin-left: 0.5rem;">(Estoque: {{ $variation->stock }})</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <span style="color: var(--text-muted); font-style: italic;">Sem variações</span>
                    @endif
                </td>
                <td style="vertical-align: middle;">
                    <div style="display: flex; gap: 0.5rem; align-items: center; justify-content: center; flex-wrap: wrap;">
                        <a href="{{ route('products.edit', $product->id) }}" class="action-btn edit" title="Editar produto">
                            <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                            Editar
                        </a>
                        
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="action-btn" style="color: var(--accent-success); background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3);" title="Adicionar ao carrinho">
                                <span class="material-symbols-outlined" style="font-size: 18px;">add_shopping_cart</span>
                                Carrinho
                            </button>
                        </form>
                        
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete" onclick="return confirm('Tem certeza que deseja excluir este produto?')" title="Excluir produto">
                                <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                Excluir
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if(count($products) === 0)
    <div class="glass-card" style="padding: 3rem; text-align: center; margin-top: 2rem;">
        <span class="material-symbols-outlined" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 1rem; display: block;">inventory_2</span>
        <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Nenhum produto encontrado</h3>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">Comece adicionando seu primeiro produto ao sistema.</p>
        <a href="{{ route('products.create') }}" class="btn-futuristic btn-primary">
            <span class="material-symbols-outlined">add</span>
            Criar Primeiro Produto
        </a>
    </div>
@endif

<style>
.page-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.product-row:hover {
    background: rgba(59, 130, 246, 0.05);
}

.action-btn:hover {
    transform: translateY(-2px) scale(1.05);
}

.cart-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: var(--accent-danger);
    color: white;
    font-size: 0.7rem;
    font-weight: 600;
    padding: 0.2rem 0.5rem;
    border-radius: 10px;
    min-width: 18px;
    text-align: center;
}

.btn-futuristic {
    position: relative;
}

#selectAll:checked ~ tbody .product-checkbox {
    checked: true;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .page-actions {
        justify-content: center;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.8rem 0.5rem;
        font-size: 0.85rem;
    }
    
    .action-btn {
        padding: 0.5rem;
        font-size: 0.8rem;
    }
    
    .action-btn span {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    
    selectAll.addEventListener('change', function() {
        productCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Auto-hide success alert
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 4000);
    });
});
</script>
@endsection