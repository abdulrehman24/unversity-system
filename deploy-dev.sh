#!/bin/bash
set -e

cd /home/proflxlj/university.professor.website || exit

echo "=================================================================================="
echo "🚀 Starting Laravel Deployment (Dev)"
echo "=================================================================================="

# Configure Git to avoid merge errors
git config pull.rebase false

# Reset and pull latest changes
echo "→ Resetting and pulling latest changes..."
git reset --hard
git clean -fd
git pull origin dev

# Set correct file permissions
echo "→ Setting permissions for storage and bootstrap/cache..."
find storage -type d -exec chmod 775 {} \;
find bootstrap/cache -type d -exec chmod 775 {} \;
chown -R $USER:www-data storage bootstrap/cache

# Install Composer dependencies (with optimized autoloader)
echo "→ Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Run Laravel artisan tasks
echo "→ Running artisan commands..."
php artisan down || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan up

echo "=================================================================================="
echo "✅ Deployment complete!"
echo "=================================================================================="
