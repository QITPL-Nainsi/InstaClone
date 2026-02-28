FROM php:7.4-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

RUN php artisan storage:link || true

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/framework/testing bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD ["sh", "-c", "mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/framework/testing bootstrap/cache && chmod -R 775 storage bootstrap/cache && php artisan config:clear && php artisan cache:clear || true; php artisan migrate --force || echo 'migrate failed'; php artisan db:seed --force || echo 'seed failed'; php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
