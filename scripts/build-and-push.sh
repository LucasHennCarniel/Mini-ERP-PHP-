#!/bin/bash

# Script para build e push no Docker Hub
echo "🐳 Fazendo build da imagem Docker..."

# Definir variáveis
IMAGE_NAME="mini-erp-laravel"
DOCKER_USERNAME="seu-usuario-dockerhub"  # Substitua pelo seu usuário
VERSION="latest"

# Fazer build da imagem
docker build -t $IMAGE_NAME:$VERSION .

# Fazer tag para o Docker Hub
docker tag $IMAGE_NAME:$VERSION $DOCKER_USERNAME/$IMAGE_NAME:$VERSION

# Login no Docker Hub (será solicitado usuário e senha)
echo "🔐 Fazendo login no Docker Hub..."
docker login

# Push da imagem para o Docker Hub
echo "📤 Enviando imagem para o Docker Hub..."
docker push $DOCKER_USERNAME/$IMAGE_NAME:$VERSION

echo "✅ Imagem enviada com sucesso para o Docker Hub!"
echo "📋 Para usar a imagem: docker pull $DOCKER_USERNAME/$IMAGE_NAME:$VERSION"
