#!/bin/bash

# Run liquibase with the volumes and networks configured, as well as the defaults file
docker run --rm -v ./changelog:/liquibase/changelog bvz/liquibase-mysql  --defaults-file=/liquibase/changelog/liquibase.prod.properties "$@"