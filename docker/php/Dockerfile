FROM mileschou/phalcon:7.2-fpm

ENV SYMFONY_ENV=prod
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN  curl -sS https://getcomposer.org/installer | php -- \
                --install-dir=/usr/local/bin \
                --filename=composer

RUN apt-get update && apt-get install -y libssl-dev && rm -rf /var/lib/apt/lists/*

RUN pecl channel-update pecl.php.net && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && docker-php-ext-enable redis