# 🐳 EXPLICAÇÃO DETALHADA DO DOCKER-COMPOSE.YML

## 📋 ESTRUTURA GERAL:
version: '3.8'  # Versão do Docker Compose

services:       # Lista de containers que serão criados

## 🚀 CONTAINER 1: APP (Aplicação Laravel)
  app:
    build:                           # Constrói uma imagem personalizada
      context: .                     # Usa o diretório atual
      dockerfile: Dockerfile         # Segue instruções do Dockerfile
    image: mini-erp-laravel:latest  # Nome da imagem criada
    container_name: mini-erp-app    # Nome do container
    restart: unless-stopped         # Reinicia automaticamente se falhar
    ports:
      - "8080:80"                   # Porta 8080 da sua máquina → Porta 80 do container
    environment:                    # Variáveis de ambiente
      - APP_ENV=production          # Laravel em modo produção
      - DB_HOST=mysql              # Se conecta ao container mysql
    volumes:                        # Pastas compartilhadas
      - ./storage:/var/www/html/storage     # Pasta storage sincronizada
    networks:
      - mini-erp-network           # Rede para comunicação entre containers

## 💾 CONTAINER 2: MYSQL (Banco de Dados)
  mysql:
    image: mysql:8.0               # Usa imagem oficial do MySQL do Docker Hub
    container_name: mini-erp-mysql
    ports:
      - "3307:3306"               # Porta 3307 da sua máquina → Porta 3306 do container
                                  # (3307 para não conflitar com MySQL do Laragon)
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword    # Senha do root
      MYSQL_DATABASE: mini_erp             # Cria banco automaticamente
    volumes:
      - mysql_data:/var/lib/mysql         # Dados do MySQL persistem aqui
    healthcheck:                          # Verifica se MySQL está funcionando
      test: ["CMD", "mysqladmin", "ping"]

## 🌐 CONTAINER 3: PHPMYADMIN (Interface Web do MySQL)
  phpmyadmin:
    image: phpmyadmin/phpmyadmin    # Imagem oficial do Docker Hub
    ports:
      - "8081:80"                  # Acesso via http://localhost:8081
    environment:
      PMA_HOST: mysql              # Se conecta ao container mysql
      UPLOAD_LIMIT: 100M           # Permite uploads maiores

## ⚡ CONTAINER 4: REDIS (Cache - Opcional)
  redis:
    image: redis:7-alpine          # Imagem leve do Redis
    ports:
      - "6379:6379"               # Porta padrão do Redis

## 💾 VOLUMES (Armazenamento Persistente)
volumes:
  mysql_data:                     # Volume para dados do MySQL
    driver: local                 # Armazenado localmente

## 🌐 NETWORKS (Redes)
networks:
  mini-erp-network:              # Rede interna para containers se comunicarem
    driver: bridge               # Tipo de rede

## 🏗️ ARQUITETURA DETALHADA - COMO FUNCIONA NA PRÁTICA

### 🎯 CONCEITO IMPORTANTE:
**UM CONTAINER = UMA RESPONSABILIDADE ESPECÍFICA**

Não é um container dentro do outro! São containers separados que conversam entre si.

### 📦 DETALHAMENTO DE CADA CONTAINER:

#### 🚀 CONTAINER APP (mini-erp-app):
```
┌─────────────────────────────────────────┐
│  🐳 Container mini-erp-app              │
│  ┌─────────────────────────────────────┐ │
│  │  🌐 Apache Web Server (porta 80)   │ │
│  │  ┌─────────────────────────────────┐ │ │
│  │  │  🔧 PHP 8.2 + Extensões        │ │ │
│  │  │  ┌─────────────────────────────┐ │ │ │
│  │  │  │  🚀 APLICAÇÃO LARAVEL       │ │ │ │
│  │  │  │  ├── 🎨 Frontend (Blade)    │ │ │ │
│  │  │  │  ├── ⚙️ Backend (PHP)       │ │ │ │
│  │  │  │  ├── 🎮 Controllers         │ │ │ │
│  │  │  │  ├── 📊 Models              │ │ │ │
│  │  │  │  ├── 🎭 Views               │ │ │ │
│  │  │  │  └── 🎨 CSS/JS              │ │ │ │
│  │  │  └─────────────────────────────┘ │ │ │
│  │  └─────────────────────────────────┘ │
│  └─────────────────────────────────────┘ │
└─────────────────────────────────────────┘
```

#### 💾 CONTAINER MYSQL (mini-erp-mysql):
```
┌─────────────────────────────────────────┐
│  🐳 Container mini-erp-mysql            │
│  ┌─────────────────────────────────────┐ │
│  │  💾 MySQL Server 8.0               │ │
│  │  ├── 📊 Database: mini_erp          │ │
│  │  ├── 👤 User: root                  │ │
│  │  ├── 🔒 Password: rootpassword      │ │
│  │  └── 📁 Data Storage                │ │
│  └─────────────────────────────────────┘ │
└─────────────────────────────────────────┘
```

#### 🌐 CONTAINER PHPMYADMIN (mini-erp-phpmyadmin):
```
┌─────────────────────────────────────────┐
│  🐳 Container mini-erp-phpmyadmin       │
│  ┌─────────────────────────────────────┐ │
│  │  🌐 Apache + PHP                   │ │
│  │  └── 📱 Interface Web phpMyAdmin    │ │
│  │      └── 🔗 Conecta no MySQL       │ │
│  └─────────────────────────────────────┘ │
└─────────────────────────────────────────┘
```

### 🔗 COMO ELES SE COMUNICAM:

```
👤 USUÁRIO
│
├── 🌐 http://localhost:8080 ────────┐
│                                   │
│   ┌───────────────────────────────▼─────────────────────────────────┐
│   │  🚀 Container APP                                               │
│   │  ├── Recebe requisição HTTP                                    │
│   │  ├── Processa com Laravel (PHP)                                │
│   │  ├── 🔗 Conecta no MySQL via rede interna                     │
│   │  │   └── DB_HOST=mysql (nome do container)                     │
│   │  ├── ⚡ Usa Redis para cache (opcional)                        │
│   │  └── 📤 Retorna HTML/CSS/JS para o usuário                    │
│   └─────────────────────────────────────────────────────────────────┘
│                                   │
├── 📊 http://localhost:8081 ────────┼─────────────────────────────────┐
│                                   │                                 │
│                                   ▼                                 │
│   ┌───────────────────────────────────────────────────────────────┐ │
│   │  💾 Container MYSQL                                           │ │
│   │  ├── Armazena dados do ERP                                    │ │
│   │  ├── Tabelas: products, orders, etc                          │ │
│   │  └── Escuta na porta 3306 (interna)                          │ │
│   └───────────────────────────────────────────────────────────────┘ │
│                                                                     │
│   ┌─────────────────────────────────────────────────────────────────▼┐
│   │  🌐 Container PHPMYADMIN                                         │
│   │  ├── Interface web para gerenciar MySQL                         │
│   │  └── 🔗 Conecta no MySQL via rede interna                      │
│   └──────────────────────────────────────────────────────────────────┘
│
└── ⚡ Redis (localhost:6379) para cache e sessões
```

### 🎯 RESUMINDO A RESPOSTA À SUA PERGUNTA:

#### ❌ NÃO É ASSIM:
```
Container 1
├── Container Frontend
├── Container Backend  
└── Container Database
```

#### ✅ É ASSIM:
```
Container APP (Frontend + Backend juntos)
Container MYSQL (Apenas banco)
Container PHPMYADMIN (Apenas interface)
Container REDIS (Apenas cache)
```

### 💡 POR QUE FUNCIONA ASSIM:

1. **🚀 Container APP**: Sua aplicação Laravel COMPLETA
   - Frontend e Backend no mesmo lugar
   - Como se fosse seu Laragon, mas isolado

2. **💾 Container MYSQL**: Apenas o banco de dados
   - Separado para poder escalar independentemente
   - Dados persistem mesmo se app for reiniciado

3. **🌐 Container PHPMYADMIN**: Apenas uma ferramenta
   - Interface web para gerenciar o banco
   - Poderia ser removido sem afetar a aplicação

4. **⚡ Container REDIS**: Apenas cache
   - Opcional, para performance
   - Sessões e cache temporário

### 🔄 FLUXO DE UMA REQUISIÇÃO:

1. **👤 Usuário** acessa http://localhost:8080
2. **🌐 Windows** redireciona para Container APP
3. **🚀 Container APP** processa com Laravel
4. **💾 Laravel** consulta dados no Container MYSQL
5. **📤 Container APP** retorna página HTML pronta
6. **👤 Usuário** vê a página no navegador

**É como se você tivesse 4 computadores separados, cada um com uma função!** 🖥️
