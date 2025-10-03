@echo off
REM Script para Windows - Build e Push no Docker Hub

echo 🐳 Fazendo build da imagem Docker...

REM Definir variáveis
set IMAGE_NAME=mini-erp-laravel
set DOCKER_USERNAME=seu-usuario-dockerhub
set VERSION=latest

REM Fazer build da imagem
docker build -t %IMAGE_NAME%:%VERSION% .

REM Fazer tag para o Docker Hub
docker tag %IMAGE_NAME%:%VERSION% %DOCKER_USERNAME%/%IMAGE_NAME%:%VERSION%

REM Login no Docker Hub
echo 🔐 Fazendo login no Docker Hub...
docker login

REM Push da imagem para o Docker Hub
echo 📤 Enviando imagem para o Docker Hub...
docker push %DOCKER_USERNAME%/%IMAGE_NAME%:%VERSION%

echo ✅ Imagem enviada com sucesso para o Docker Hub!
echo 📋 Para usar a imagem: docker pull %DOCKER_USERNAME%/%IMAGE_NAME%:%VERSION%

pause
