#!/bin/bash

DIR=$(pwd)

cd ./dist/app
composer install --prefer-dist --no-dev --optimize-autoloader
zip -rD9 ../app.zip . -x ".env*"

cd $pwd