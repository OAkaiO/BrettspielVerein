#!/bin/bash

# Run liquibase with the volumes and networks configured, as well as the defaults file
docker run --network=brettspielverein_bvz_network --rm -v ./changelog:/liquibase/changelog bvz/liquibase-mysql  --defaults-file=/liquibase/changelog/liquibase.dev.properties "$@"