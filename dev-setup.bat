@echo off
echo 🚀 Mini ERP Laravel - Scripts de Desenvolvimento

echo.
echo Escolha uma opção:
echo [1] Rodar com Laragon (desenvolvimento local)
echo [2] Rodar com Docker (produção)
echo [3] Rodar com Docker DEV (desenvolvimento + hot reload)
echo [4] Build Docker e Push para Docker Hub
echo [5] Atualizar dependências no Docker
echo [6] Limpar containers Docker
echo [7] Ver logs Docker
echo [8] Backup do banco MySQL
echo.

set /p choice="Digite sua escolha (1-8): "

if "%choice%"=="1" goto laragon
if "%choice%"=="2" goto docker
if "%choice%"=="3" goto docker_dev
if "%choice%"=="4" goto build_push
if "%choice%"=="5" goto update_deps
if "%choice%"=="6" goto cleanup
if "%choice%"=="7" goto logs
if "%choice%"=="8" goto backup
goto end

:laragon
echo.
echo 🔧 Configurando para Laragon...
copy .env.example .env 2>nul
php artisan key:generate
php artisan migrate
php artisan db:seed
echo.
echo ✅ Projeto configurado para Laragon!
echo 🌐 Acesse: http://mini-erp-laravel.test
echo 📊 phpMyAdmin: http://localhost/phpmyadmin
goto end

:docker
echo.
echo 🐳 Iniciando com Docker (PRODUÇÃO)...
copy .env.docker .env
docker-compose up --build -d
echo.
echo ✅ Containers Docker PRODUÇÃO iniciados!
echo 🌐 Aplicação: http://localhost:8080
echo 📊 phpMyAdmin: http://localhost:8081
echo 💾 MySQL: localhost:3307
goto end

:docker_dev
echo.
echo 🔥 Iniciando com Docker DEV (HOT RELOAD)...
copy .env.docker .env
docker-compose -f docker-compose.dev.yml up --build -d
echo.
echo ✅ Containers Docker DEV iniciados!
echo 🔥 HOT RELOAD ATIVO - Mudanças aparecem automaticamente!
echo 🌐 Aplicação: http://localhost:8080
echo 📊 phpMyAdmin: http://localhost:8081
echo 💾 MySQL: localhost:3307
echo.
echo 💡 DICA: Edite seus arquivos normalmente, as mudanças aparecerão automaticamente!
goto end

:build_push
echo.
echo 📦 Build e Push para Docker Hub...
set /p username="Digite seu usuário Docker Hub: "
docker build -t mini-erp-laravel:latest .
docker tag mini-erp-laravel:latest %username%/mini-erp-laravel:latest
docker login
docker push %username%/mini-erp-laravel:latest
echo ✅ Imagem enviada para Docker Hub!
goto end

:update_deps
echo.
echo 📦 Atualizando dependências no Docker...
echo.
echo Escolha:
echo [1] Atualizar Composer
echo [2] Atualizar NPM
echo [3] Atualizar ambos
echo [4] Rebuild completo
echo.
set /p dep_choice="Digite sua escolha (1-4): "

if "%dep_choice%"=="1" (
    docker exec mini-erp-app composer update
    echo ✅ Composer atualizado!
)
if "%dep_choice%"=="2" (
    docker exec mini-erp-app npm update
    docker exec mini-erp-app npm run build
    echo ✅ NPM atualizado!
)
if "%dep_choice%"=="3" (
    docker exec mini-erp-app composer update
    docker exec mini-erp-app npm update
    docker exec mini-erp-app npm run build
    echo ✅ Composer e NPM atualizados!
)
if "%dep_choice%"=="4" (
    docker-compose down
    docker-compose build --no-cache
    docker-compose up -d
    echo ✅ Rebuild completo realizado!
)
goto end

:cleanup
echo.
echo 🧹 Limpando containers Docker...
docker-compose down -v
docker-compose -f docker-compose.dev.yml down -v
docker system prune -f
docker volume prune -f
echo ✅ Cleanup concluído!
goto end

:logs
echo.
echo 📋 Logs dos containers:
echo.
echo [1] Ver logs produção
echo [2] Ver logs desenvolvimento
echo [3] Ver logs específicos
echo.
set /p log_choice="Digite sua escolha (1-3): "

if "%log_choice%"=="1" docker-compose logs -f
if "%log_choice%"=="2" docker-compose -f docker-compose.dev.yml logs -f
if "%log_choice%"=="3" (
    set /p container="Digite o nome do container: "
    docker logs -f %container%
)
goto end

:backup
echo.
echo 💾 Backup do banco MySQL...
set timestamp=%date:~-4,4%%date:~-10,2%%date:~-7,2%_%time:~0,2%%time:~3,2%%time:~6,2%
set timestamp=%timestamp: =0%
docker exec mini-erp-mysql mysqldump -u root -prootpassword mini_erp > backup_%timestamp%.sql
echo ✅ Backup salvo como: backup_%timestamp%.sql
goto end

:end
echo.
pause
