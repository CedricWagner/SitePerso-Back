# Site perso -- back

Repository of my personnal website (back end and back office only) based on Symfony.

---

[![Unit & Functional Tests](https://github.com/CedricWagner/SitePerso-Back/actions/workflows/run-tests.yaml/badge.svg)](https://github.com/CedricWagner/SitePerso-Back/actions/workflows/run-tests.yaml)

## Requirements

- docker and docker-compose
- npm 

## Installation

1. Clone the project: `git clone https://github.com/CedricWagner/SitePerso-Back.git .`
2. Start the docker container and access it:  `cd docker && make up && make shell`
3. Install composer dependencies: `composer install`
4. Setup DB and load fixtures: `php bin/console doctrine:migrations:migrate --env=test && php bin/console doctrine:fixtures:load --env=test`
5. From your local machine and from the root of the application, install npm dependencies: `npm install`
6. Access the back office from: [backend.site-perso.localhost:8000](backend.site-perso.localhost:8000)

## Testing

### Unit & Functional

```bash
php bin/phpunit # from the container
```

### Coding standards

```bash
# install cs fixer
composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer 
# apply fixes
PHP_CS_FIXER_IGNORE_ENV=1 tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
```