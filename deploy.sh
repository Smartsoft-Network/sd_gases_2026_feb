#!/bin/bash

# Exit on error
set -e

echo "Starting deployment..."

# Install composer dependencies
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Install and build assets
npm install
npm run build

# Clear old cache
php artisan cache:clear

echo "Deployment finished successfully!"
