#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node dependencies and build assets
npm install
npm run build

# Clear caches
php artisan optimize:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force
