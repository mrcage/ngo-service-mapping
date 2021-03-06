# NGO Service Mapping Web Application

## Requirements

* Webserver (e.g. Apache or Nginx)
* PHP 7.4+ with the following extensions:
  * BCMath
  * Ctype
  * Fileinfo
  * GD
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
    php artisan cache:clear
    php artisan view:cache
    php artisan config:cache
    php artisan route:cache
    php artisan migrate --force

## Docker container

Ensure the following values are set in the `.env` file:

    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_password

Run these commands:

    docker-compose up --build -d
    docker-compose exec web php artisan migrate --seed

Visit http://localhost:8000 to open the application.

## Heroku deployment

Make sure [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli) is installed.

Create an app:

    heroku create --region eu <APPNAME>

Add a database (PostgreSQL):

    heroku addons:create heroku-postgresql:hobby-dev
    heroku config:set DB_CONNECTION=pgsql

Set application key:

    php artisan key:generate --show
    heroku config:set APP_KEY=...

Configure logging (so one can use `heroku log --tail`):

    heroku config:set LOG_CHANNEL=errorlog

Push code to heroku git repository:

    git push heroku HEAD:master

Run database migrations if needed, with seeder:

    heroku run php artisan migrate --seed --force

Open application in browser:

    heroku open

See https://devcenter.heroku.com/articles/getting-started-with-laravel

To send e-mails via [Mailgun](https://www.mailgun.com/), configure the following settings:

    heroku config:set MAIL_MAILER=mailgun
    heroku config:set MAILGUN_DOMAIN=...
    heroku config:set MAILGUN_SECRET=...
