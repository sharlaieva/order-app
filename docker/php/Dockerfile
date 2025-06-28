FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl libpq-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql intl zip pdo_mysql

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
