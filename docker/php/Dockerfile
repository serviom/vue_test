FROM php:8.2-fpm

WORKDIR /var/www/test

RUN apt-get update && apt-get install -y \
    libonig-dev \
    pkg-config \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    libxml2-dev \
    curl

RUN apt install curl

RUN curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash

SHELL ["/bin/bash", "-c"]
RUN source /root/.profile && nvm install 18.17 &&  nvm use 18.17

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl
#RUN docker-php-ext-install gd
#RUN docker-php-ext-install soap

COPY . .

WORKDIR /var/www/test/docker/backend/example-app
CMD npm install && npm run dev


EXPOSE 9000
CMD ["php-fpm"]
