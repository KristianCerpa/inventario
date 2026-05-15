#!/bin/sh

set -e

php artisan queue:work --tries=3 --max-time=3600
