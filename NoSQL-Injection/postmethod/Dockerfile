FROM php:7.4-apache

RUN pecl install mongodb \
  && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini \
  && docker-php-ext-enable mongodb

COPY ./ /var/www/html/
