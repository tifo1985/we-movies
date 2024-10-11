# WeMovies

WeMovies est une application web développée en utilisant Symfony. Elle permet de gérer des informations sur les films, leurs genres, et leurs détails, tout en respectant les principes de la **Clean Architecture**. Ce projet est structuré de manière à maintenir une séparation claire entre la logique métier, la persistance des données, et l'interface utilisateur.

## Structure des Dossiers

Voici la structure principale des dossiers du projet :

```WeMovies/
├── src/
│   ├── Domain/                # Contient la logique métier principale (entités, cas d'utilisation, interfaces)
│   │   ├── Entity/            # Entités représentant les objets métier
│   │   ├── Gateway/           # Interfaces des adaptateurs pour les services externes et le stockage des données
│   │   ├── Request/           # Objets de requête pour les cas d'utilisation
│   │   ├── Response/          # Objets de réponse pour les cas d'utilisation
│   │   └── UseCase/           # Cas d'utilisation définissant la logique métier
│   ├── Infrastructure/        # Implémentations des interfaces de la couche domaine
│   │   └── Ports/             # Adaptateurs pour la persistance et autres services
│   └── UserInterface/         # Couche de présentation (contrôleurs)
│       └── Controller/        # Contrôleurs d'interface utilisateur pour l'application
├── tests/                     # Contient les tests unitaires et fonctionnels
│   └── Domain/                # Tests de la logique métier
│       └── UseCase/           # Tests pour les cas d'utilisation
├── .env                       # Fichier de configuration d'environnement
├── composer.json              # Dépendances PHP du projet
├── docker-compose.yml         # Configuration de l'environnement de développement Docker
└── README.md                  # Documentation du projet
```

## Architecture

Le projet utilise les concepts de la Clean Architecture, qui vise à :
- Rendre le code indépendant des frameworks.
- Limiter les dépendances entre les couches.
- Faciliter les tests unitaires et l’évolution du projet.

### Illustration de la Clean Architecture

Voici une représentation simplifiée de la Clean Architecture utilisée dans ce projet :

![Clean Architecture](https://storage.googleapis.com/bitloops-github-assets/Documentation%20Images/Clean-Architecture-Uncle-Bob.png)

- **Domain** : Contient la logique métier principale, les entités et les cas d'utilisation.
- **Infrastructure** : Fournit les implémentations spécifiques pour la persistance des données et les services externes.
- **UserInterface** : Inclut les contrôleurs, les vues, et tout ce qui est nécessaire pour l'interface utilisateur.

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Docker et Docker Compose (pour la configuration de l'environnement de développement)
- Node.js et npm (pour gérer les assets frontend)

## Installation

1. Clonez le dépôt :
```bash
   git clone https://github.com/tifo1985/WeMovies.git
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