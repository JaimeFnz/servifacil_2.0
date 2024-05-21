#!/bin/bash

# Limpiar la caché de la aplicación
php artisan cache:clear

# Limpiar la caché de configuración
php artisan config:clear

# Limpiar la caché de rutas
php artisan route:clear

# Limpiar la caché de vistas
php artisan view:clear

# Limpiar la caché de eventos
php artisan event:clear

echo "Todas las cachés han sido limpiadas."
