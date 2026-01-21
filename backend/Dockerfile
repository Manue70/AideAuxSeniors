FROM php:8.4-apache

# Dépendances système + extensions PHP
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpq-dev libonig-dev libicu-dev \
    && docker-php-ext-install zip pdo pdo_pgsql intl mbstring \
    && rm -rf /var/lib/apt/lists/*

# Apache : pointer sur public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Laravel
WORKDIR /var/www/html
COPY src/ .

# Dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Ne pas faire de config cache, sinon Laravel cherche un .env inexistant
# RUN php artisan config:cache
# RUN php artisan route:cache
# RUN php artisan view:clear

# 🔎 DEBUG TEMPORAIRE pour Render
RUN echo "<?php phpinfo();" > public/debug.php

EXPOSE 80

CMD ["apache2-foreground"]
