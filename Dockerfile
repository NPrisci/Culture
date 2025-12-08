FROM php:8.1-fpm-alpine

# Installer les dépendances système
RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxml2-dev \
    zip \
    unzip \
    oniguruma-dev \
    freetype-dev \
    nginx \
    supervisor

# Installer les extensions PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    sockets

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Créer l'utilisateur et groupe www-data
RUN addgroup -g 1000 -S www-data && \
    adduser -u 1000 -S www-data -G www-data

# Créer le répertoire de travail
WORKDIR /var/www

# Copier les fichiers de l'application
COPY . .

# Changer les permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap/cache

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]