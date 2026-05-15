#!/bin/bash

# Enable error display for debugging
export APP_DEBUG=true

# Debug: print environment variables
echo "=== Environment Variables ==="
env | sort
echo "==========================="

# Ensure APP_URL is valid
if [ -z "$APP_URL" ] || [ "$APP_URL" = "https://" ] || [ "$APP_URL" = "http://" ]; then
    echo "APP_URL is invalid, setting to http://localhost"
    export APP_URL="http://localhost"
fi

# If DATABASE_URL is provided by Railway, parse it
if [ -n "$DATABASE_URL" ]; then
    echo "Using DATABASE_URL from Railway"
    export DB_CONNECTION=pgsql
    
    # Parse DATABASE_URL (format: postgresql://user:pass@host:port/dbname)
    DB_URL=$(echo "$DATABASE_URL" | sed 's|postgresql://||')
    DB_USER_PASS=$(echo "$DB_URL" | cut -d@ -f1)
    DB_HOST_PORT=$(echo "$DB_URL" | cut -d@ -f2 | cut -d/ -f1)
    DB_NAME=$(echo "$DB_URL" | cut -d@ -f2 | cut -d/ -f2)
    
    export DB_USERNAME=$(echo "$DB_USER_PASS" | cut -d: -f1)
    export DB_PASSWORD=$(echo "$DB_USER_PASS" | cut -d: -f2)
    export DB_HOST=$(echo "$DB_HOST_PORT" | cut -d: -f1)
    export DB_PORT=$(echo "$DB_HOST_PORT" | cut -d: -f2)
    export DB_DATABASE=$DB_NAME
    
    echo "Parsed DB values:"
    echo "  DB_HOST=$DB_HOST"
    echo "  DB_PORT=$DB_PORT"
    echo "  DB_DATABASE=$DB_DATABASE"
    echo "  DB_USERNAME=$DB_USERNAME"
fi

echo "APP_URL=$APP_URL"
echo "APP_KEY=$APP_KEY"
echo "DB_CONNECTION=$DB_CONNECTION"
echo "DB_HOST=$DB_HOST"
echo "DB_PORT=$DB_PORT"
echo "DB_DATABASE=$DB_DATABASE"
echo "DB_USERNAME=$DB_USERNAME"
echo "PORT=$PORT"

# Set permissions
echo "=== Setting permissions ==="
chmod -R 777 storage bootstrap/cache 2>&1 || true

# Clear caches
echo "=== Clearing caches ==="
php artisan config:clear 2>&1 || true
php artisan cache:clear 2>&1 || true
php artisan route:clear 2>&1 || true
php artisan view:clear 2>&1 || true

# Run migrations
echo "=== Running migrations ==="
php artisan migrate --force --no-interaction 2>&1 || echo "Migrations completed with warnings"

# Start the server with error logging
echo "=== Starting server ==="
php artisan serve --host=0.0.0.0 --port=${PORT:-3000}
