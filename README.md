# Docker

This template has been designed to meet the following requirements:

A backend container with official dockerhub image php: 8.1-fpm PHP version 8.1 and Supervisor with php command artisan queue: work

A frontend container with the official dockerhub node image: latest and angular CLI

A mysql container with official mysql: latest dockerhub image

A phpmyadmin container with the official dockerhub image phpmyadmin / phpmyadmin, linked to the mysql container in order to access the DB

A webserver container with the official image of the dockerhub nginx: alpine

## Init Docker


The /docker/backend/supervisor/supervisord.conf file is linked in the backend container. Editing that file is instantly replicated to the container

First installation

Proceed with the copy of the .env.example file for setting the project and user name to be created for DB mysql

`cp .env.example .env`

then:

`docker-compose build`

Wait for everything to be configured

Then:

`docker-compose up -d`

Once all the containers are initialized, you need to connect to the backend container:

`docker exec -t -i backendLaravel /bin/bash`

we will find ourselves already in the folder /var/www/backend

Proceed with the copy of the .env.example file ( Change only mysql db name, user and password with the same .env docker istance)

`cp .env.example .env`

we install all the dependencies:

`composer install`

For the backend it is not necessary to execute the command php artisan because the nginx container is linked on the public laraver folder


So here are the links currently configured:

backend: `localhost`

frontend: `localhost:8080`

## Running end-to-end tests


//TODO
'Разработать на laravel + vue one page application список задач (to-do), где будет просто выводиться список задач

Можно добавить новое задание (простая строка)
Можно удалить задание
Можно выполнить задание (зачеркнутый текст)
Задача должна выполнятся в том числе автоматически через 5 минут
При добавлении 2 задач, 3 автоматически выполняется

Всю логику реализуем встроенным функционалом Laravel.'

