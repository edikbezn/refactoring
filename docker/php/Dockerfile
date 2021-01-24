FROM php:7.4-fpm-alpine

RUN apk add php7-dev \
    && apk add gcc \
    && apk add g++ \
    && apk add make \
    && apk add git \
    && apk add curl \
    && apk add wget \
    && apk add grep \
    && apk add zlib-dev \
    && apk add curl-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN wget https://phar.phpunit.de/phpunit-9.5.phar \
    && mv phpunit-9.5.phar /usr/local/bin/phpunit \
    && cd /usr/local/bin/ && chmod 755 phpunit


WORKDIR /var/www

CMD ["php-fpm"]