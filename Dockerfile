FROM php:8.2-apache

# Install dependensi sistem yang dibutuhkan
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm

# Install ekstensi PHP untuk Laravel dan PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql pgsql zip gd

# Aktifkan mod_rewrite Apache (wajib untuk routing Laravel)
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ubah Document Root Apache ke folder public/ milik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set folder kerja
WORKDIR /var/www/html

# Salin semua file proyek ke dalam server
COPY . .

# Install package PHP (tanpa file dev)
RUN composer install --optimize-autoloader --no-dev

# Install package Node.js dan compile Tailwind CSS
RUN npm install && npm run build

# Berikan hak akses penuh ke folder yang butuh ditulis oleh Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Buka port 80
EXPOSE 80

# Jalankan optimasi, migrasi database otomatis, lalu nyalakan Apache
CMD php artisan optimize:clear && php artisan migrate --force && apache2-foreground
