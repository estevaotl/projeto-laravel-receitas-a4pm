FROM php:8.3-fpm

# Instala dependências
RUN apt-get update && apt-get install -y \
    netcat-openbsd \
    libpng-dev libjpeg-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala Node.js 20 e npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www
COPY . .

# Permissões
RUN chown -R www-data:www-data storage bootstrap/cache resources/js public/build

EXPOSE 9000
CMD ["php-fpm"]

