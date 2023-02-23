FROM composer:2.5 AS composer
COPY ./composer.json /app
COPY ./composer.lock /app

RUN composer install

FROM php:8.1-fpm

WORKDIR /var/www/html

COPY . .
COPY --from=composer /app/vendor ./vendor/