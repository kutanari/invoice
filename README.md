### Instalation

please install docker first, make sure docker is available in the system.

then go to main directory and make setup only for the first time

` $ make setup`

```sh
docker-compose up -d --build
Building app
[+] Building 175.2s (5/6)
 => [internal] load .dockerignore                                                                                                                                                                                                                      0.4s
 => => transferring context: 2B                                                                                                                                                                                                                        0.0s
 => [internal] load build definition from Dockerfile                                                                                                                                                                                                   0.3s
 => => transferring dockerfile: 38B                                                                                                                                                                                                                    0.1s
 => [internal] load metadata for docker.io/webdevops/php-nginx:7.4-alpine
 ...
```

after setup the system will run and, for the next time just run bellow command to start and stop

`$ make start //to start the container`

`$ make stop //to stop the container`

after container is up, please run migration before start using app build database and seeds

`$ make migrate`

to reset the migration run this command

`$ make reset-migration`