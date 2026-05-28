FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpng-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD php artisan config:clear \
    && php artisan cache:clear \
    && php artisan storage:link || true; \
    php artisan migrate --force \
    && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
