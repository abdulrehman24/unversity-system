#!/bin/bash
set -e

# Change to the Laravel application directory
cd /home/proflxlj/university.professor.website || exit

echo "=================================================================================="
echo "🚀 Starting Laravel Deployment (Dev)"
echo "=================================================================================="

# Reset and pull latest changes from dev branch
echo "→ Resetting and pulling latest changes..."
git reset --hard
git pull origin dev

# Set proper permissions
echo "→ Setting permissions for storage and bootstrap/cache..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Install Composer dependencies
echo "→ Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Run Laravel artisan commands
echo "→ Running artisan commands..."
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=================================================================================="
echo "✅ Deployment complete!"
echo "=================================================================================="
