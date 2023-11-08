FROM php:8.2-cli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update
RUN apt-get install git-all -y

WORKDIR /code
COPY composer.*  .
RUN composer install
RUN composer dump-autoload