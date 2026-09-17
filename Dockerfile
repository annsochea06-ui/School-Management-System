# ប្រើប្រាស់ PHP 8.2 ជាមួយ Apache
FROM php:8.2-apache

# ដំឡើង System dependencies និង PHP Extensions សម្រាប់ PostgreSQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# បើក Apache rewrite module
RUN a2enmod rewrite

# កំណត់ Apache Document Root ទៅកាន់ folder public របស់ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# កំណត់ Working directory
WORKDIR /var/www/html

# ចម្លង Code ទាំងអស់ចូល Docker Container
COPY . .

# ដំឡើង Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# កំណត់ Permission លើ Folder storage និង cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# កំណត់ Port សម្រាប់ Render
EXPOSE 80

# រត់ Apache Web Server
CMD ["apache2-foreground"]