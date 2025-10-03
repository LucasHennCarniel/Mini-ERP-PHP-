#!/bin/bash
set -e

# Aguardar banco de dados estar disponível
echo "🔄 Aguardando banco de dados..."
while ! mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" --silent; do
    sleep 1
done
echo "✅ Banco de dados conectado!"

# Executar migrações se necessário
if [ "$APP_ENV" = "production" ]; then
    echo "🔄 Executando migrações..."
    php artisan migrate --force
    
    echo "🔄 Limpando cache..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Executar comando passado como argumento
exec "$@"
