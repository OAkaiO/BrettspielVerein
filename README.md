# Homepage Brettspielverein Zofingen
## Setting up dev env
### Required tools
- docker
- docker-compose

### Run the application locally
First, prepare the `.env` file by copying and renaming the `.env.example` file. To run the website in a local environment, simply run `docker-compose up -d`. This will set up a local PHP server and the SMTP mock server to check the mails, as well as the MySQL DB. 

The website will be available on 'localhost:80' and the mail server GUI is available on 'localhost:3000'. The DB can be connected to with any data base viewer under port 3306 with user `root` and password `example`.

## Release the website
### Build the release
To build the release, run the environment locally as described above. Then, run `docker exec brettspielverein_server_1 tar -cf dist/app.tar app/` to bundle the application up.

### Push the release to the host
**Make sure to not delete the .env file during the installation process!**

To "install" the website on the host, simply upload the created zip, and unzip it into the folder to which the URL is mapped. Then, create a `.env` file in the newly created folder based on the `.env.example` file, and fill in the appropriate values.
