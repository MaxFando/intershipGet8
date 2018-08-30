FROM phalconphp/php-fpm:7-min

ENV SYMFONY_ENV=prod
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN  curl -sS https://getcomposer.org/installer | php -- \
                --install-dir=/usr/local/bin \
                --filename=composer

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

COPY composer.json ./
COPY composer.lock ./

RUN composer install --no-dev --no-suggest --no-progress --prefer-dist --no-scripts \
    && rm -rf /root/.composer/cache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo pdo_mysql