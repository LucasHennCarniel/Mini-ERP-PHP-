@echo off
echo 🐳 GUIA RÁPIDO - COMANDOS DOCKER
echo.

echo ========================================
echo 📋 COMANDOS BÁSICOS PARA INICIANTES
echo ========================================
echo.

echo 1️⃣ VER CONTAINERS RODANDO:
echo    docker ps
echo.

echo 2️⃣ VER TODAS AS IMAGENS:
echo    docker images
echo.

echo 3️⃣ VER TODOS OS CONTAINERS (rodando e parados):
echo    docker ps -a
echo.

echo 4️⃣ INICIAR O PROJETO:
echo    docker-compose up -d
echo.

echo 5️⃣ PARAR O PROJETO:
echo    docker-compose down
echo.

echo 6️⃣ VER LOGS EM TEMPO REAL:
echo    docker-compose logs -f
echo.

echo 7️⃣ ENTRAR DENTRO DE UM CONTAINER:
echo    docker exec -it mini-erp-app bash
echo.

echo 8️⃣ REBUILD IMAGENS:
echo    docker-compose up --build -d
echo.

echo ========================================
echo 🌐 ONDE ACESSAR DEPOIS DE RODAR
echo ========================================
echo.
echo 🚀 Aplicação Laravel:  http://localhost:8080
echo 📊 phpMyAdmin:         http://localhost:8081
echo 💾 MySQL:              localhost:3307
echo ⚡ Redis:              localhost:6379
echo.

echo ========================================
echo 🔧 TROUBLESHOOTING
echo ========================================
echo.
echo ❌ Se der erro de porta ocupada:
echo    netstat -ano | findstr :8080
echo    taskkill /PID [numero_do_processo] /F
echo.

echo 🔄 Se containers não iniciarem:
echo    docker-compose down
echo    docker system prune -f
echo    docker-compose up --build -d
echo.

echo 📱 Testar se está funcionando:
echo    curl http://localhost:8080
echo.

pause
