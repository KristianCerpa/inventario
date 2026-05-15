#!/bin/bash

# Debug: print environment variables
echo "=== Environment Variables ==="
env | sort
echo "==========================="

# Ensure APP_URL is valid
if [ -z "$APP_URL" ] || [ "$APP_URL" = "" ]; then
    echo "APP_URL is empty, setting to http://localhost"
    export APP_URL="http://localhost"
fi

echo "APP_URL=$APP_URL"
echo "APP_KEY=$APP_KEY"
echo "DB_CONNECTION=$DB_CONNECTION"
echo "DB_HOST=$DB_HOST"
echo "DB_PORT=$DB_PORT"
echo "DB_DATABASE=$DB_DATABASE"
echo "DB_USERNAME=$DB_USERNAME"
echo "PORT=$PORT"

# Run migrations
echo "=== Running migrations ==="
php artisan migrate --force --no-interaction 2>&1 || echo "Migrations completed with warnings"

# Start the server
echo "=== Starting server ==="
php artisan serve --host=0.0.0.0 --port=${PORT:-3000}
