# 🔄 GUIA COMPLETO - ATUALIZAÇÕES NO DOCKER

## 🎯 ESTRATÉGIAS DE ATUALIZAÇÃO

### 📝 TIPO 1: ATUALIZAÇÕES DE CÓDIGO (PHP, Blade, CSS, JS)

#### ✅ MÉTODO RECOMENDADO - Hot Reload (Desenvolvimento):

1️⃣ **Edite seu código normalmente no Laragon**
2️⃣ **Use volume mount para sincronização automática**

```yaml
# No docker-compose.yml (modo desenvolvimento)
volumes:
  - .:/var/www/html              # Sincroniza TUDO
  - ./storage:/var/www/html/storage
  - ./bootstrap/cache:/var/www/html/bootstrap/cache
```

3️⃣ **Comandos:**
```bash
# Iniciar em modo desenvolvimento
docker-compose -f docker-compose.dev.yml up -d

# Mudanças aparecem automaticamente!
# Não precisa rebuild!
```

#### 🔄 MÉTODO PRODUÇÃO - Rebuild:

```bash
# 1. Pare os containers
docker-compose down

# 2. Rebuild com novas mudanças
docker-compose up --build -d

# 3. Ou rebuild apenas o app
docker-compose build app
docker-compose up -d
```

---

### 🐘 TIPO 2: ATUALIZAR VERSÃO DO PHP

#### 📝 Editar Dockerfile:

```dockerfile
# Alterar a linha:
FROM php:8.2-apache  # versão atual
# Para:
FROM php:8.3-apache  # nova versão
```

#### 🔨 Comandos para aplicar:

```bash
# 1. Parar containers
docker-compose down

# 2. Remover imagem antiga
docker rmi mini-erp-laravel:latest

# 3. Rebuild com nova versão PHP
docker-compose build --no-cache app

# 4. Iniciar
docker-compose up -d
```

---

### 💾 TIPO 3: ATUALIZAR MYSQL/REDIS/OUTROS SERVIÇOS

#### 📝 Editar docker-compose.yml:

```yaml
mysql:
  image: mysql:8.0    # versão atual
  # Para:
  image: mysql:8.1    # nova versão
```

#### ⚠️ CUIDADO COM DADOS:
```bash
# 1. Backup do banco primeiro!
docker exec mini-erp-mysql mysqldump -u root -p mini_erp > backup.sql

# 2. Parar containers
docker-compose down

# 3. Atualizar versão no docker-compose.yml

# 4. Iniciar (dados persistem no volume)
docker-compose up -d
```

---

### 📦 TIPO 4: ATUALIZAR DEPENDÊNCIAS (Composer/NPM)

#### Método 1 - Dentro do container:
```bash
# Entrar no container
docker exec -it mini-erp-app bash

# Atualizar dependências
composer update
npm update && npm run build

# Sair
exit
```

#### Método 2 - Rebuild:
```bash
# 1. Atualizar composer.json/package.json localmente
# 2. Rebuild
docker-compose build --no-cache app
docker-compose up -d
```

---

## 🏗️ WORKFLOW RECOMENDADO PARA DESENVOLVIMENTO

### 📁 Estrutura de Arquivos Docker:

```
mini-erp-laravel/
├── docker-compose.yml          # Produção
├── docker-compose.dev.yml      # Desenvolvimento
├── docker-compose.override.yml # Override local
└── Dockerfile
```

### 🔧 docker-compose.dev.yml (Hot Reload):

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile.dev    # Dockerfile específico para dev
    volumes:
      - .:/var/www/html            # Sincronização completa
      - /var/www/html/vendor       # Exceto vendor (performance)
      - /var/www/html/node_modules # Exceto node_modules
    environment:
      - APP_ENV=local
      - APP_DEBUG=true

# ... outros serviços iguais
```

### 🔧 Dockerfile.dev (Para desenvolvimento):

```dockerfile
FROM php:8.2-apache

# ... instalações básicas ...

# Instalar Xdebug para desenvolvimento
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Não copiar código (vem via volume)
WORKDIR /var/www/html

# Não rodar composer install (volume já tem vendor/)

EXPOSE 80
CMD ["apache2-foreground"]
```

---

## 🚀 COMANDOS RÁPIDOS PARA DIFERENTES CENÁRIOS

### 📝 Mudança de Código:
```bash
# Desenvolvimento (hot reload)
docker-compose -f docker-compose.dev.yml up -d

# Produção (rebuild)
docker-compose build app && docker-compose up -d
```

### 🐘 Mudança de PHP:
```bash
# Editar Dockerfile
# Depois:
docker-compose build --no-cache app
docker-compose up -d
```

### 📦 Mudança de Dependências:
```bash
# Opção 1: Dentro do container
docker exec -it mini-erp-app composer update

# Opção 2: Rebuild
docker-compose build --no-cache app
```

### 💾 Mudança de Banco:
```bash
# Backup primeiro!
docker exec mini-erp-mysql mysqldump -u root -p mini_erp > backup.sql

# Editar docker-compose.yml
# Depois:
docker-compose down
docker-compose up -d
```

---

## 🔄 CI/CD - AUTOMAÇÃO COMPLETA

### 📋 Script de Deploy Automático:

```bash
#!/bin/bash
# deploy.sh

echo "🚀 Iniciando deploy..."

# 1. Pull do código
git pull origin main

# 2. Backup do banco
docker exec mini-erp-mysql mysqldump -u root -p mini_erp > "backup_$(date +%Y%m%d_%H%M%S).sql"

# 3. Build nova imagem
docker-compose build --no-cache

# 4. Deploy com zero downtime
docker-compose up -d

# 5. Executar migrações
docker exec mini-erp-app php artisan migrate --force

# 6. Limpar cache
docker exec mini-erp-app php artisan cache:clear

echo "✅ Deploy concluído!"
```

---

## 🎯 RESPOSTA DIRETA ÀS SUAS PERGUNTAS

### ❓ "Devo subir no local, atualizar e realocar?"
**✅ SIM, para desenvolvimento - Use hot reload**

### ❓ "Posso duplicar, atualizar e subir?"
**✅ SIM, para produção - Use rebuild**

### 🏆 MELHOR PRÁTICA:
1. **Desenvolvimento**: Hot reload com volumes
2. **Produção**: Rebuild com versionamento
3. **CI/CD**: Automação completa

**Nunca perca dados e sempre tenha backup! 📦**
