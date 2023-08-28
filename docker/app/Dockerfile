FROM php:8.1-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
    # gd
    && apt-get install -y --no-install-recommends build-essential  openssl nginx libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev nodejs npm \
    && docker-php-ext-configure gd  \
    && docker-php-ext-install gd \
    # gmp
    && apt-get install -y --no-install-recommends libgmp-dev \
    && docker-php-ext-install gmp \
    # pdo_mysql
    && docker-php-ext-install pdo_mysql mbstring \
    # pdo
    && docker-php-ext-install pdo \
    # opcache
    && docker-php-ext-enable opcache \
    # zip
    && docker-php-ext-install zip \
    && apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/pear/

# Install php-redis using PECL
RUN pecl install redis && \
    docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

# Install xdebug
RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

WORKDIR /var/www/html

# php-fpm runs with default user www-data. https://stackoverflow.com/questions/48619445/permission-denied-error-using-laravel-docker
# If you want to change it, change the username in /usr/local/etc/php-fpm.d/www.conf.
RUN chown -R www-data:www-data /var/www/html
