# 1. Use PHP 8.1 with Apache (Perfect for Laravel 9)
FROM php:8.2-apache

# 2. Install System Dependencies & Node 18 (Includes libpq-dev for Postgres)
RUN apt-get update \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install PHP Extensions required by Laravel (Uses pdo_pgsql for Postgres)
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# 4. Enable Apache mod_rewrite (required for Laravel routing)
RUN a2enmod rewrite

# 5. Configure Apache to point to Laravel's 'public' folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Set Working Directory
WORKDIR /var/www/html

# 8. Copy Project Files into the container
COPY . .

# 9. Install Backend Dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 10. Install Frontend Dependencies & Upgrade Mix to v6 for Webpack 5 compatibility
RUN npm install --production=false --legacy-peer-deps \
    && npm install laravel-mix@latest webpack@5 --save-dev --legacy-peer-deps \
    && npm run prod

# 11. Set Correct Permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 12. Create a startup script
RUN echo '#!/bin/bash\n\
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf\n\
php artisan migrate --force\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
apache2-foreground' > /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

# 13. Start the application
CMD ["/usr/local/bin/start.sh"]
