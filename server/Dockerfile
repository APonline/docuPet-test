# Use an official PHP image as a parent image
FROM php:8.1.2-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

# Set the working directory in the container
#WORKDIR /var/www/html

#RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set the working directory in the container
WORKDIR /app

COPY composer*.json ./
COPY composer*.lock ./
COPY symfony*.lock ./

RUN rm -vf /var/lib/apt/lists/*

RUN apt-get update \
    && apt-get install -y libzip-dev git wget --no-install-recommends \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#RUN apt install php-mysql
RUN docker-php-ext-install pdo mysqli pdo_mysql zip;

RUN apt-get install git -y

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \ && composer install --no-interaction --no-plugins --no-scripts

# Copy the Symfony application code
COPY . .

RUN composer require jms/serializer-bundle
RUN composer require friendsofsymfony/rest-bundle
RUN composer require symfony/maker-bundle
RUN composer require symfony/orm-pack
RUN composer require symfony/debug-bundle --dev

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENV SYMFONY_PHPUNIT_VERSION=9

# Expose port 8000 (Apache default port)
EXPOSE 8000

# Command to run Apache server
ENTRYPOINT ["docker-entrypoint"]

CMD ["apache2-foreground"]