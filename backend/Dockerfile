# Étape 1 : builder frontend
FROM node:20 AS node-builder
WORKDIR /app
COPY backend/src/package*.json ./
RUN npm install
COPY backend/src/resources ./resources
RUN npm run build

# Étape 2 : container PHP + Laravel
FROM php:8.4-apache

# Extensions système
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpq-dev libonig-dev libicu-dev \
    && docker-php-ext-install zip pdo pdo_pgsql intl mbstring \
    && rm -rf /var/lib/apt/lists/*

# Apache public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY backend/src/ .

# Dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Copier le build frontend déjà créé
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Cache Laravel (OK car env vars Render)
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear

EXPOSE 80
CMD ["apache2-foreground"]


