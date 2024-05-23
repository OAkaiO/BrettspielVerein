#!/bin/bash

DIR=$(pwd)

cd app
composer install --prefer-dist --no-dev --optimize-autoloader
zip -rD9 ../dist/app.zip . -x ".env*"

cd $pwd