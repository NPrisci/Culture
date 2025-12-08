#!/bin/bash

echo "🚀 Déploiement du projet Culture..."

# 1. Vérifier les variables d'environnement
if [ ! -f .env.production ]; then
    echo "❌ Fichier .env.production manquant"
    exit 1
fi

# 2. Construire l'image Docker localement (test)
echo "🔨 Construction de l'image Docker..."
docker build -t culture-app:latest .

# 3. Pousser sur Docker Hub (optionnel)
# docker tag culture-app:latest votreusername/culture-app:latest
# docker push votreusername/culture-app:latest

# 4. Exécuter les migrations et seeders en local (test)
echo "🌱 Exécution des migrations..."
docker run --env-file .env.production culture-app:latest php artisan migrate --force

# 5. Vérifier la santé de l'application
echo "🏥 Test de santé..."
docker run --env-file .env.production -p 8080:80 culture-app:latest &
sleep 10
curl -f http://localhost:8080/health || echo "❌ Échec du test de santé"

echo "✅ Prêt pour le déploiement sur Render!"
echo "👉 Poussez sur GitHub et allez sur https://render.com"