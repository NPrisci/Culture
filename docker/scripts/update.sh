#!/bin/bash

echo "🔄 Mise à jour de Culture Bénin..."

# Pull des dernières images
docker-compose pull

# Redémarrer les conteneurs
docker-compose down
docker-compose up -d

# Mettre à jour les dépendances
docker-compose exec app composer install --no-dev --optimize-autoloader

# Exécuter les migrations
docker-compose exec app php artisan migrate --force

# Clear le cache
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear

echo "✅ Mise à jour terminée!"