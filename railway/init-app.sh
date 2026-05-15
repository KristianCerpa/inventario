#!/bin/bash

set -e

echo "=== Running migrations ==="
php artisan migrate --force --no-interaction || echo "Migration warning: non-critical error"

echo "=== Creating storage link ==="
php artisan storage:link 2>/dev/null || true

echo "=== Setting permissions ==="
chmod -R 755 storage bootstrap/cache || true

echo "=== Starting PHP-FPM ==="
php-fpm -F
