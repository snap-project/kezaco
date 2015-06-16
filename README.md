# Kezaco

Base de données et moteur de recherche libre d'activités pédagogiques

## Tester avec Docker & Compose

Installer [Docker](https://docs.docker.com/installation/) et [Compose](https://docs.docker.com/compose/install/)

Dans dans votre terminal:

```bash
cd kezaco
./composer install
docker-compose up # Peut prendre un certain temps la première fois
```
Dans un autre terminal, ouvrir une session sur le conteneur web:
```bash
docker exec -ti kezaco_web_1 bash
# Se placer dans le répertoire de l'application
cd /app
# Mettre à jour le schéma de la base
app/console doctrine:schema:update --force
# Charger les fixtures
app/console doctrine:fixtures:load
```

Puis ouvrez votre navigateur à l'adresse `http://localhost:8080/web`
