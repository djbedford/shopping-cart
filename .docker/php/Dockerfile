FROM php:7.3-fpm

LABEL maintainer="David Bedford"

COPY . /var/www/html/
COPY .docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html/

RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install pdo_mysql