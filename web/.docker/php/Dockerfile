
FROM php:7.2-fpm

ENV XDEBUG="false"


RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    gcc \
    libmcrypt-dev \
    libjpeg-dev \
    libpng-dev \
    libmagickwand-dev --no-install-recommends \
    libfreetype6-dev \
    openssl \
    mysql-client \
    curl \
    zip \
    unzip


RUN pecl config-set php_ini  /usr/local/etc/php/php.ini \
    && pecl install mcrypt-1.0.2 && docker-php-ext-enable mcrypt \
    && pecl install imagick && docker-php-ext-enable imagick \
    && pecl install xdebug && docker-php-ext-enable xdebug


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN docker-php-ext-install mbstring \
    pdo \
    pdo_mysql \
    xml \
    json \
    tokenizer \
    fileinfo \
    ctype \
    bcmath \
    gd \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-enable mcrypt mbstring



WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

