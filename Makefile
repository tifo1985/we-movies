# Variables
DOCKER_COMPOSE = docker-compose
COMPOSER = composer
NPM = npm

# Commandes de configuration
install:
	$(COMPOSER) install

install-frontend:
	$(NPM) install

# Commandes Docker
start:
	$(DOCKER_COMPOSE) up -d

stop:
	$(DOCKER_COMPOSE) down

# Commandes pour les assets
build-assets:
	$(NPM) run build

# Tests
test:
	$(DOCKER_COMPOSE) exec php bin/phpunit
