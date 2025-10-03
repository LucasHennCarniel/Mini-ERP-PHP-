# � Mini ERP Laravel - Laragon + Docker

Este projeto suporta desenvolvimento com **Laragon** e deployment com **Docker + Terraform**.

## �️ Pré-requisitos

### Para Desenvolvimento (Laragon):
- Laragon instalado
- PHP 8.2+
- MySQL/MariaDB
- Composer

### Para Produção (Docker):
- Docker Desktop
- Terraform
- Conta Docker Hub (opcional)

## 🎯 Desenvolvimento com Laragon

### 1. Setup Automático
```bash
# Execute o script de setup
dev-setup.bat

# Escolha opção 1 para Laragon
```

### 2. Setup Manual
```bash
# Copiar arquivo de ambiente
copy .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Configurar banco no .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_erp
DB_USERNAME=root
DB_PASSWORD=

# Rodar migrações
php artisan migrate
php artisan db:seed
```

### 3. Configurar Virtual Host no Laragon
1. Copie o conteúdo de `laragon-vhost.conf`
2. Cole em: `C:\laragon\etc\apache2\sites-enabled\mini-erp-laravel.conf`
3. Reinicie o Laragon
4. Acesse: `http://mini-erp-laravel.test`

## 🐳 Produção com Docker

### 1. Preparação Local

```bash
# Clone o projeto (se necessário)
git clone <seu-repositorio>
cd mini-erp-laravel

# Copie o arquivo de ambiente
cp .env.production .env

# Gere a chave da aplicação Laravel
php artisan key:generate
```

### 2. Build e Teste Local com Docker Compose

```bash
# Build e iniciar todos os containers
docker-compose up --build -d

# Verificar se os containers estão rodando
docker-compose ps

# Acessar a aplicação: http://localhost:8080
# Acessar phpMyAdmin: http://localhost:8081
```

### 3. Deploy com Terraform

```bash
# Navegar para o diretório terraform
cd terraform

# Inicializar Terraform
terraform init

# Planejar o deployment
terraform plan

# Aplicar a infraestrutura
terraform apply

# Confirmar com 'yes' quando solicitado
```

### 4. Publicar no Docker Hub (Opcional)

```bash
# Editar o script com seu usuário do Docker Hub
# Windows:
scripts/build-and-push.bat

# Linux/Mac:
chmod +x scripts/build-and-push.sh
./scripts/build-and-push.sh
```

## 🔧 Configuração para Docker Hub

### Modificar Terraform para usar imagem do Docker Hub:

1. Edite `terraform/main.tf`
2. Substitua o bloco `docker_image.app` por:

```hcl
# Container da aplicação Laravel usando imagem do Docker Hub
resource "docker_container" "app" {
  image = "seu-usuario/mini-erp-laravel:latest"  # Substitua pelo seu usuário
  name  = "${var.app_name}-app"
  
  # ... resto da configuração permanece igual
}
```

## 📱 URLs de Acesso

### Laragon (Desenvolvimento):
- **Aplicação**: http://mini-erp-laravel.test
- **phpMyAdmin**: http://localhost/phpmyadmin
- **MySQL**: localhost:3306

### Docker (Produção):
- **Aplicação**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
- **MySQL**: localhost:3307

## ⚙️ Scripts Disponíveis

### Windows (dev-setup.bat)
```bash
dev-setup.bat
```
**Opções:**
1. Configurar para Laragon
2. Rodar com Docker
3. Build e Push Docker Hub
4. Limpar containers
5. Ver logs

## 🔄 Workflow Recomendado

### Desenvolvimento:
1. Use **Laragon** para desenvolvimento local
2. Teste mudanças rapidamente
3. Debug com ferramentas familiares

### Deploy:
1. Use **Docker** para testes de produção
2. Deploy com **Terraform**
3. Publique no **Docker Hub**

## 🐛 Troubleshooting

### Container não inicia
```bash
# Verificar logs
docker logs mini-erp-app

# Verificar se as portas estão livres
netstat -ano | findstr :8080
```

### Problema com permissões (Linux/Mac)
```bash
# Ajustar permissões
sudo chown -R $USER:$USER storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Erro de conexão com banco
1. Verificar se o container MySQL está rodando
2. Confirmar variáveis de ambiente
3. Aguardar alguns segundos para o MySQL inicializar completamente

### Problemas com Laragon:
```bash
# Verificar se Apache/MySQL estão rodando
# Verificar virtual host configurado
# Verificar permissões de pasta
```

### Problemas com Docker:
```bash
# Ver logs
docker-compose logs -f

# Restart containers
docker-compose restart

# Rebuild
docker-compose up --build -d
```

### Conflito de Portas:
- Laragon MySQL: porta 3306
- Docker MySQL: porta 3307
- Laragon Apache: porta 80
- Docker Apache: porta 8080

## 📁 Estrutura de Arquivos

```
mini-erp-laravel/
├── dev-setup.bat              # Script de desenvolvimento
├── laragon-vhost.conf         # Configuração Laragon
├── .env.docker               # Ambiente Docker
├── .env.example              # Ambiente Laragon
├── docker-compose.yml        # Orquestração Docker
├── Dockerfile               # Imagem da aplicação
├── docker-entrypoint.sh     # Script de entrada
└── terraform/               # Infraestrutura
    ├── main.tf
    └── outputs.tf
```
