# VAT Calculator Application

A symfony application to Compute VAT.

## Setup

### Install dependencies

Install/build php packages, and javascript packages. Finally build javascript

```
composer install
yarn install --force
yarn build
```

### Create database

```
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force --complete
```

## Start Symfony server

```
symfony serve
```

Vist browser to view application
https://127.0.0.1:8000/

## Testing

```
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:create
```

Run the Tests

```
php bin/phpunit
```
