# Dockerfile
FROM php:7.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

WORKDIR /app/

RUN cd /server

COPY . /app/server

RUN composer install

RUN php bin/console make:migration

RUN php bin/console doctrine:migrations:migrate

#RUN symfony server:start
CMD [ "symfony", "server:start" ]

EXPOSE 8000



# Vue FRONTEND
FROM node:lts-alpine

# install simple http server for serving static content
RUN npm install -g http-server

# make the 'app' folder the current working directory
WORKDIR /app

RUN cd /docupet

# copy both 'package.json' and 'package-lock.json' (if available)
COPY package*.json ./

# install project dependencies
RUN npm install

# copy project files and folders to the current working directory (i.e. 'app' folder)
COPY /app/docupet/dist .

# build app for production with minification
RUN npm run build

EXPOSE 8080
CMD [ "http-server", "dist" ]

