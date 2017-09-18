FROM php:7.0-fpm

RUN apt-get update && \
    apt-get install -yqq libmcrypt-dev libpq-dev graphviz  && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install pdo && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install mcrypt

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

COPY docker-components/php/php.ini /usr/local/etc/php/conf.d/custom.ini

RUN sed -ri 's/^www-data:x:33:33:/www-data:x:1000:50:/' /etc/passwd
RUN mkdir /var/log/ecpm
RUN chown -R 1000:1000 /tmp /var/log/ecpm