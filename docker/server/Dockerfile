FROM php:8.2-cli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update
RUN apt-get install git-all -y
RUN apt-get install zip -y
RUN docker-php-ext-install pdo pdo_mysql
