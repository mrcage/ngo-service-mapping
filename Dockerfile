FROM php:7.4-fpm

RUN apt-get update -y && apt-get install -y \
    libmcrypt-dev \
    openssl \
    curl \
    zlib1g-dev \
    libpng-dev \
    libzip-dev \
    unzip

RUN docker-php-ext-install bcmath pdo_mysql gd zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer install &&  \
    php artisan cache:clear &&  \
    php artisan view:cache &&  \
    php artisan config:cache &&  \
    php artisan route:cache

RUN apt-get autoclean && apt-get autoremove -y

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
