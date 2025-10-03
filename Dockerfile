# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    wget \
    nano \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP necessárias para Laravel
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar DocumentRoot do Apache para Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Habilitar módulos Apache necessários
RUN a2enmod rewrite headers

# Configurar PHP para produção
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar apenas os arquivos necessários primeiro (para melhor cache)
COPY composer.json composer.lock ./

# Instalar dependências do Composer
RUN composer install --no-scripts --no-autoloader --no-dev

# Copiar o resto dos arquivos
COPY . .

# Finalizar instalação do Composer
RUN composer dump-autoload --optimize --no-dev

# Criar diretórios necessários e definir permissões
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Script de inicialização
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expor porta 80
EXPOSE 80

# Usar script de entrada personalizado
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
