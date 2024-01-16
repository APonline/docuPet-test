# Use an official PHP image as a parent image
FROM php:8.1.2-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

# Set the working directory in the container
WORKDIR /var/www/html

# Install necessary dependencies and enable Apache modules
RUN a2enmod rewrite

RUN apt-get update \
    && apt-get install -y libzip-dev git wget --no-install-recommends \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install pdo mysqli pdo_mysql zip;

RUN wget https://getcomposer.org/download/2.0.9/composer.phar \
    && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer

# Copy the Symfony application code
COPY . .

# Install Composer and dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --no-plugins --no-scripts

# Expose the port on which the Apache server runs
EXPOSE 8000

# Command to run the Apache server
COPY . /var/www

WORKDIR /var/www

