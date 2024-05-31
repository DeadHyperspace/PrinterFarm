# Это можно редактировать
# registry.gitlab.mk-dev.ru/s3provider/s3provider/cli
ARG REGISTRY=registry.gitlab.mk-dev.ru
FROM $REGISTRY/devops/base-images/php-cli:8.1-alpine
USER root
COPY --chown=www-data:www-data . /var/www/s3provider
WORKDIR /var/www/s3provider
USER www-data
RUN touch .env; \
    rm -rf .docker
