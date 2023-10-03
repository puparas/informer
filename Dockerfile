FROM php:8.1.0-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      libicu-dev \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      docker-php-ext-configure intl && \
      docker-php-ext-install intl && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


#COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

COPY ./           /var/www

COPY composer.*  ./

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin
# alias
RUN echo "alias a='artisan'" >> /root/.bashrc

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs

RUN composer install \
      --no-interaction \
      --no-plugins \
      --no-scripts \
      --no-autoloader \
      --prefer-dist


RUN composer dump-autoload  --no-scripts --optimize && \
    chown -R root:www-data /var/www/ && \
    chmod 755 -R /var/www/ && \
    chmod -R 775 /var/www/storage && \
    chmod -R 775 /var/www/bootstrap/cache

WORKDIR /var/www

