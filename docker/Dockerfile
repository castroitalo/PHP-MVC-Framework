FROM php:8.2-apache

# Copy my apache config
COPY ./config-files/000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable apache server rewriting and install base packages
RUN a2enmod rewrite
RUN apt update && \
    apt upgrade -y && \
    apt install libzip-dev -y && \
    apt install wget -y && \
    apt install unzip -y && \
    apt install vim -y

COPY ./config-files/90-xdebug.ini "${PHP_INI_DIR}/conf.d"

# Install PHP extensions
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install zip pdo_mysql 

# Copy script to install composer and my php.ini config file
COPY ./config-files/install-composer.sh ./
COPY ./config-files/php.ini /usr/local/etc/php/

# Install composer
RUN apt purge -y g++ \
    && apt autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh ./install-composer.sh \
    && rm ./install-composer.sh

WORKDIR /var/www/html/public

CMD ["apache2-foreground"]
