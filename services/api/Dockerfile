# Composer
FROM composer:2.5.1 as composer

# Dependencies
FROM php:8.2-fpm-alpine as deps

# Copy composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Runtime deps
RUN apk add --no-cache \
		acl \
		fcgi \
		file \
		gettext \
		git \
        supervisor \
    ;

# Install PHP Extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
        gd \
        redis \
        imagick \
    	intl \
    	zip \
    	apcu \
		opcache \
        pdo_pgsql \
        pgsql \
        pcntl \
        exif \
    ;

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY ./docker/php/api.ini $PHP_INI_DIR/conf.d/
COPY ./docker/php/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

RUN rm -Rf docker/
RUN mkdir -p /var/run/php

# Prod image
FROM deps as final
WORKDIR /var/www
