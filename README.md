# NGO Service Mapping Web Application

## Requirements

* Webserver (e.g. Apache or Nginx)
* PHP 7.4+ with the following extensions:
  * BCMath
  * Ctype
  * Fileinfo
  * JSON
  * Mbstring
  * OpenSSL
  * PDO
  * Tokenizer
  * XML
* MySQL / MariaDB database
* Composer package manager
* NodeJS / NPM (for compilation of assets during development)

## Installation

Checkout the repository and run composer:

    composer install

Copy `.env.example` to `.env` and adapt values accordingly (e.g. database configuration).

Run database migations and populate tables:

    artisan migrate --seed

Install Javascript packages and compile assets:

    npm install
    npm run dev

## Deployment

    composer install --optimize-autoloader --no-dev
    artisan cache:clear
    artisan view:cache
    artisan config:cache
    artisan route:cache
    artisan migrate --force

## Run as docker container

    docker-compose up -d
    docker-compose exec app composer install
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate
