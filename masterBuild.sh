#!/bin/bash
set -x
LIQUIBASE_DOCKER_IMAGE=bvz/liquibase-mysql:latest
DIST_DIR=./dist/app

buildBackendForDev() {
    docker run --rm \
        --volume ./backend:/app \
        --user $(id -u):$(id -g) \
        composer/composer install
    docker run --rm \
        --volume ./backend:/app \
        --user $(id -u):$(id -g) \
        composer/composer dump-autoload
}

buildBackendForIT() {
    cp -r backend/api $DIST_DIR
    cp backend/.env $DIST_DIR
    cp backend/composer.json $DIST_DIR
    cp backend/composer.lock $DIST_DIR

    docker run --rm \
        --volume $DIST_DIR:/app \
        --user $(id -u):$(id -g) \
        composer/composer install
    docker run --rm \
        --volume $DIST_DIR:/app \
        --user $(id -u):$(id -g) \
        composer/composer dump-autoload
}

buildFrontend() {
    npm run --prefix vue generate
    cp -r vue/.output/public/* $DIST_DIR
}

buildDbDockerImage() {
    docker build --build-arg USER_ID=$(id -u) docker/liquibase -t $LIQUIBASE_DOCKER_IMAGE
}

buildDist() {
    clean
    mkdir -p ./dist/app

    buildFrontend
    buildBackendForIT

    docker run --rm \
        --volume $DIST_DIR:/app \
        --user $(id -u):$(id -g) \
        composer/composer install --prefer-dist --no-dev --optimize-autoloader

    zip -rD9 ./dist/app.zip ./dist/app -x "./dist/app/.env*"
}

clean() {
    rm -rf $DIST_DIR/app
    rm $DIST_DIR/app.zip
}

dev() {
    docker compose --profile dev up -d
}

installFrontend() {
    docker run -v ./vue:/home/node/app -w /home/node/app -u node node:22.14.0-alpine npm install --silent
}

inttest() {
    buildDist

    docker compose --profile inttest up -d
}

awaitDbAlive() {
    i=0
    while [[ $i -lt 10 ]]; do
        sleep 30
        echo "------ Log check #$((i + 1))/10 ($(date)) ------"
        docker logs --tail 10 brettspielverein-db-1 2>&1 | grep "mysqld: ready for connections."
	if [[ $? -eq 0 ]]; then
	       return
        fi	       
        ((i++))
    done
    echo "DB was not ready within 5 minutes!"
    exit 1
}

migrateDb() {
    docker compose --profile db up -d
    awaitDbAlive
    docker run --network=brettspielverein_bvz_network \
        --rm -v ./db/liquibase/changelog:/liquibase/changelog $LIQUIBASE_DOCKER_IMAGE \
        --defaults-file=/liquibase/changelog/liquibase.dev.properties update --changelogFile changelog/root.changelog.yaml
}

setup() {
    buildDbDockerImage
    migrateDb

    installFrontend

    buildBackendForDev
    cp ./backend/.env.example ./backend/.env
}

stop() {
    docker compose --profile "*" down
}

usage() {
    cat <<EOF
Usage: $0 [OPTION]... TARGET

Options:
  -h, --help        Show this help message and exit

Arguments:
  TARGET            The task to execute

Description:
  This script can be used to execute all relevant task related to building,
  testing and running the website.

  TARGET is a required argument and must be one of the following values:
    - dev: Starts backend, frontend, DB and mail server in their own containers
    - inttest: Builds the frontend and backend, and deploys them together
    - setup: Prepares the project for development.
    - stop: Stops any running instances.

  You can combine any options in any order before specifying TARGET.
EOF
}

target=""

POSITIONAL_ARGS=()

# Parse flags and collect the rest
while [[ $# -gt 0 ]]; do
    case "$1" in
    -h | --help)
        usage
        exit 0
        ;;
    -*)
        echo "Unknown option: $1"
        usage
        exit 1
        ;;
    *)
        POSITIONAL_ARGS+=("$1")
        shift
        ;;
    esac
done

# Restore positional parameters
set -- "${POSITIONAL_ARGS[@]}"

# Check if final positional argument exists
if [[ $# -lt 1 ]]; then
    echo "Error: Missing mandatory TARGET argument."
    usage
    exit 1
fi

# Assign final argument as target
target="$1"

# Validate TARGET
case "$target" in
buildDist)
    buildDist
    ;;
dev)
    dev
    ;;
inttest)
    inttest
    ;;
setup)
    setup
    ;;
stop)
    stop
    ;;
*)
    echo "Error: Invalid TARGET value '$target'. Must be one of: buildDist, dev, inttest, setup, stop"
    usage
    exit 1
    ;;
esac
