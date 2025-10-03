<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mini ERP Laravel - Sistema Futurista</title>
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- Background Animation -->
        <div class="bg-animation">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" onclick="toggleSidebar()">
            <span class="material-symbols-outlined">menu</span>
        </button>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" onclick="closeSidebar()"></div>

        <!-- Main Container -->
        <div class="app-container">
            <!-- Sidebar Navigation -->
            <nav class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <div class="logo">
                        <span class="logo-icon">⚡</span>
                        <span class="logo-text">Mini ERP</span>
                    </div>
                    <button class="sidebar-close" onclick="closeSidebar()">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <div class="nav-menu">
                    <a href="{{ url('/') }}" class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('products.index') }}" class="nav-item {{ request()->is('products*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <span class="nav-text">Produtos</span>
                    </a>
                    
                    <a href="{{ route('stocks.index') }}" class="nav-item {{ request()->is('stocks*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">warehouse</span>
                        <span class="nav-text">Estoque</span>
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="nav-item {{ request()->is('cart*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span class="nav-text">Carrinho</span>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="cart-badge">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('checkout.show') }}" class="nav-item {{ request()->is('checkout*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">payment</span>
                        <span class="nav-text">Checkout</span>
                    </a>
                    
                    <a href="{{ route('orders.index') }}" class="nav-item {{ request()->is('orders*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <span class="nav-text">Pedidos</span>
                    </a>
                    
                    <a href="{{ route('coupons.index') }}" class="nav-item {{ request()->is('coupons*') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">local_offer</span>
                        <span class="nav-text">Cupons</span>
                    </a>
                </div>
                
                <div class="sidebar-footer">
                    <div class="user-info">
                        <div class="user-avatar">
                            <span class="material-symbols-outlined">person</span>
                        </div>
                        <div class="user-details">
                            <span class="user-name">Administrador</span>
                            <span class="user-role">Sistema ERP</span>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </main>
        </div>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.querySelector('.sidebar-overlay');
                const body = document.body;
                
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
                body.classList.toggle('sidebar-open');
            }
            
            function closeSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.querySelector('.sidebar-overlay');
                const body = document.body;
                
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                body.classList.remove('sidebar-open');
            }
            
            // Close sidebar on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 1024) {
                    closeSidebar();
                }
            });
            
            // Add smooth scrolling to all anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        </script>

        @stack('scripts')
    </body>
</html>
