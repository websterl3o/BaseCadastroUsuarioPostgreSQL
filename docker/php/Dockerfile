FROM php:8.3-fpm

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    curl \
    libpq-dev \
    && docker-php-ext-install zip pdo_mysql

# Instalar Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Instalar Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar extensões do PHP
RUN docker-php-ext-install pdo pdo_pgsql

# Criar pastas necessárias e ajustar permissões
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

WORKDIR /var/www
