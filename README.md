# WeMovies

WeMovies est une application web qui utilise Symfony pour gérer des informations sur les films, leurs genres, et leurs détails.

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Docker et Docker Compose (pour la configuration de l'environnement de développement)
- Node.js et npm (pour gérer les assets frontend)

## Installation

1. Clonez le dépôt :
```bash
   git clone https://github.com/votre-utilisateur/WeMovies.git
   cd WeMovies
``` 

2. Installez les dépendances PHP :
```bash
   make install
```
3. Installez les dépendances Node.js :
```bash
  make install-frontend
```
4. Copiez le fichier .env.dist vers .env et configurez les variables d'environnement nécessaires :
```bash
   cp .env.dist .env
```
Changer les valeurs de `THEMOVIEDB_URL` et `THEMOVIEDB_BEARER_TOKEN`

5. Démarrez les conteneurs Docker :
```bash
   make start
```

7. Compilez les assets :
```bash
   make build-assets
```

## Lancer l'application

Après avoir démarré les conteneurs Docker, l'application sera disponible à l'adresse http://localhost:8089.

## Tests
```bash
   make test
```


## Commandes Makefile

| Commande              | Description                                        |
|-----------------------|----------------------------------------------------|
| `make install`        | Installe les dépendances PHP                       |
| `make install-frontend` | Installe les dépendances Node.js                    |
| `make start`          | Démarre les services Docker                        |
| `make stop`           | Arrête les services Docker                         |
| `make build-assets`   | Compile les assets avec Webpack Encore             |
| `make test`           | Exécute les tests PHPUnit                          |