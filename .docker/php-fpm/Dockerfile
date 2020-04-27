FROM php:7.0-fpm
RUN pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug \
    && apt-get update \
    && apt-get install --no-install-recommends -y libpq-dev \
    && docker-php-ext-install pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
