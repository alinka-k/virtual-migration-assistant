# PHP Version alpine image to install based on the PHP_VERSION environment variable
FROM php:7.4-fpm-alpine

COPY php.ini $PHP_INI_DIR
# Install Additional dependencies
RUN apk update && apk add --no-cache build-base shadow nano bash libzip-dev icu-dev \
   jpeg-dev imagemagick libpng-dev libjpeg-turbo-dev freetype-dev \
   php7 \
   php7-fpm \
   php7-common \
   php7-pdo \
   php7-pdo_mysql \
   php7-mysqli \
   php7-mcrypt \
   php7-mbstring \
   php7-xml \
   php7-openssl \
   php7-json \
   php7-phar \
   php7-zip \
   php7-gd \
   php7-dom \
   php7-session \
   php7-zlib

# Install extensions
RUN docker-php-ext-install mysqli pdo_mysql zip intl

RUN docker-php-ext-configure gd \
  --enable-gd \
  --with-freetype \
  --with-jpeg && \
NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
docker-php-ext-install -j${NPROC} gd


RUN apk add composer

RUN rm -rf /var/cache/apk/*

# Add UID '1000' to www-data
RUN apk add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN apk add alpine-sdk
RUN apk add autoconf tzdata
RUN pecl install redis
RUN docker-php-ext-enable redis
RUN apk del alpine-sdk
RUN docker-php-ext-install pcntl
RUN apk add e2fsprogs-extra

#RUN yes | pecl install xdebug
#RUN docker-php-ext-enable xdebug

RUN apk del autoconf

RUN cp /usr/share/zoneinfo/Europe/Kiev /etc/localtime
# Copy existing application directory permissions
#RUN chown -R www-data:www-data /var/www
RUN apk add --update supervisor && rm  -rf /tmp/* /var/cache/apk/*
ADD supervisord.conf /etc/supervisor/

COPY ./conf.d /etc/supervisor/conf.d
COPY supervisord.conf /etc/supervisor/

COPY crontab /var/spool/cron/crontabs/app
RUN crontab /var/spool/cron/crontabs/app

#USER www-data
EXPOSE 9000
CMD ["supervisord", "--nodaemon", "-c", "/etc/supervisor/supervisord.conf"]
