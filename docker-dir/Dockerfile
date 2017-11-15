FROM php:7-apache

RUN apt-get update \
    && apt-get install -y wget git vim

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer

RUN pecl install xdebug-2.5.0 \
    && docker-php-ext-enable xdebug

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /code/api/web

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf