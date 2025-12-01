#!/bin/sh

# Limpiar caches antes de iniciar
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan optimize:clear

# Si usas spatie/laravel-permission
php artisan permission:cache-reset || true

# Arrancar servidor
exec php artisan serve --host=0.0.0.0 --port=8000 --no-reload
