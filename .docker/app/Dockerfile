
FROM php:8.1-fpm
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql
USER root
COPY conf/php.ini /usr/local/etc/php/php.ini
COPY conf/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY --chown=www-data:www-data . /var/www/farm3d
WORKDIR /var/www/farm3d
USER www-data
RUN touch .env; \
    rm -rf .docker
