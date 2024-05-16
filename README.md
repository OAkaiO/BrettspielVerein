# Homepage Brettspielverein Zofingen
## Setting up dev env
### Required tools
- docker
- docker-compose

### Run the application locally
First, prepare the `.env` file by copying and renaming the `.env.example` file. Then build the server image by running the `build.sh` in `./docker/server` (This needs to be repeated whenever new PHP dependencies are added to composer.json). Then, to run the website in a local environment, simply run `docker-compose up -d` from within the projects root folder (the one containing folders `app`, `db`, etc.). This will set up a local PHP server and the SMTP mock server to check the mails, as well as the MySQL DB. 

The website will be available on 'localhost:80' and the mail server GUI is available on 'localhost:3000'. The DB can be connected to with any data base viewer under port 3306 with user `root` and password `example`.

### Running liquibase
[Liquibase](https://docs.liquibase.com/) is used to handle database updates. To work with it, first build the docker image with the build script in `docker\liquibase`. Thne, use the provided scripts in `db/liquibase`. `runLiquibaseDev.sh` runs against the local DB and is configured completely in the `liquibase.dev.properties`. To run against the PROD DB, use `runLiquibaseProd.sh`. It expects a `liquibase.prod.properties`. Copy and rename the template file and fill it in with the correct values. It is possible to also add the password, but it's recommended to leave that away so you don't accidentally run the script (as you will have to actively include the password in the script call). To connect sucessfully, you also need to add your host to the Remote DB configuration on cPanel (get it from myip.com).

## Release the website
### Build the release
To build the release, run the environment locally as described above. Then, run `docker exec brettspielverein_server_1 tar -cf dist/app.tar app/` to bundle the application up.

### Push the release to the host
**Make sure to not delete the .env file during the installation process!**

To "install" the website on the host, simply upload the created zip, and unzip it into the folder to which the URL is mapped. Then, create a `.env` file in the newly created folder based on the `.env.example` file, and fill in the appropriate values.
