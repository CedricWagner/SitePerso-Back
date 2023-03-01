# Site perso -- back

Repository of my personnal website (back end and back office only) based on Symfony.

---

[![Basic tests](https://github.com/CedricWagner/SitePerso-Back/actions/workflows/basic-tests.yaml/badge.svg)](https://github.com/CedricWagner/SitePerso-Back/actions/workflows/basic-tests.yaml)

[![SSH Deploy](https://github.com/CedricWagner/SitePerso-Back/actions/workflows/ssh-deploy.yaml/badge.svg)](https://github.com/CedricWagner/SitePerso-Back/actions/workflows/ssh-deploy.yaml)


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

#### CS Fixer

```bash
# install cs fixer
composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer 
# apply fixes
PHP_CS_FIXER_IGNORE_ENV=1 tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
```

#### PHPStan

```bash
vendor/bin/phpstan analyse -c phpstan.neon
```