FROM php:8.3.12-fpm
COPY --from=composer:2.8.1 /usr/bin/composer /usr/local/bin/composer 
RUN pecl install redis && docker-php-ext-enable redis
RUN docker-php-ext-install mysqli
RUN  docker-php-ext-install pdo pdo_mysql
CMD "php-fpm"