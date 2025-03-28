#!/bin/bash

rm -rf ./dist/app
mkdir -p ./dist/app

cp -r backend/api ./dist/app
cp backend/.env ./dist/app
cp backend/composer.json ./dist/app
cp backend/composer.lock ./dist/app

cp -r vue/.output/public/* ./dist/app

cd dist/app
composer install
composer dump-autoload

cd ../..

docker run --network brettspielverein_bvz_network -p 80:80 --mount type=bind,src=./dist/app,target=/opt/app bvz/int-test:latest -S 0.0.0.0:80 -t /opt/app