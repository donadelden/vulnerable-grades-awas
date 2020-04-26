## AWAS Project
A vulnerable website to manage grades.

#### General instructions
`.php` file have to be placed inside `./src`



#### Instructions to run with Docker

- install [Docker](https://docs.docker.com/install/) and Docker-compose (on Linux: `sudo apt install -y docker.io docker-compose`)
- manage Docker as a non-root user (only Linux based systems) (https://docs.docker.com/install/linux/linux-postinstall/)
  - `sudo groupadd docker`
  - `sudo usermod -aG docker $USER`  
  - restart your machine (log out is not enough)
  - verify that you can run docker commands without sudo: `docker info`
- clone this repository
- from the folder of the repository `docker-compose up -d`. The first execution is slow (it has to pull the docker images). To stop the containers `docker-compose down`.
- Nginx will be available on `localhost:80` and PostgreSQL on `localhost:5432`
- credentials for PostgreSQL are in `.env` file.

#### Useful tips
- If you mess up with containers (e.g. you have conflicts because there is some container running) you can use `docker kill $(docker ps -q) && docker volume prune`
- [This could be useful in the next days, maybe] If this warning comes out _"WARNING: Error loading config file: /home/user/.docker/config.json -stat /home/user/.docker/config.json: permission denied"_, do `sudo chown "$USER":"$USER" /home/"$USER"/.docker -R` and `sudo chmod g+rwx "$HOME/.docker" -R`
- To directly access the db, with containers up, use `docker exec -it vulnerable-grades-awas_docker-db_1  /bin/bash` to get a shell inside the container and `psql --host=docker-db --username=admin --dbname=db-grades` to open Postgres. 
