FROM php:8.1.4-fpm-alpine3.15

# Download script to install PHP extensions and dependencies
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync

RUN apk update\
    &&  apk add -u \
      curl \
      git \
      zip unzip \
    && install-php-extensions \
      exif \
      gd \
      mysqli \
      opcache \
      pdo_mysql \
      redis \
      zip \
      bcmath

RUN mkdir /app

COPY . /app

# copy source files
COPY . /var/www/html

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# create a new group and user
RUN addgroup -S www
RUN adduser  -u 1000 -G www -D -S laravel
RUN chown -R laravel:www /var/www/html
RUN chown -R laravel:www /app

USER laravel