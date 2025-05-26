#!/bin/bash

# Esperar a que MySQL esté disponible
echo "Esperando a que MySQL esté disponible..."
while ! mysqladmin ping -h"mysql" -P3306 --silent; do
    sleep 1
done

echo "MySQL está disponible!"

# Ejecutar migraciones y seeders
echo "Ejecutando migraciones..."
php artisan migrate --force

echo "Ejecutando seeders (si existen)..."
php artisan db:seed --force || true

# Limpiar y optimizar cache
echo "Limpiando cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Crear enlace simbólico para storage
echo "Creando enlace simbólico para storage..."
php artisan storage:link || true

# Generar clave de aplicación si no existe
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    echo "Generando clave de aplicación..."
    php artisan key:generate --force
fi

# Asegurar permisos correctos
echo "Configurando permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Iniciando Apache..."
# Iniciar Apache en primer plano
apache2-foreground